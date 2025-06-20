<?php
include 'layouts/dashboardheader.php';
$role = $_SESSION['role'];
if ($role !== 'admin') {
    redirect("logout.php");
}

$getAllBookedEvents = $conn->prepare("SELECT * FROM bookedevent ORDER BY id DESC");
$getAllBookedEvents->execute();
$result = $getAllBookedEvents->fetchAll();
?>
<style>
  #eventsTable th, #eventsTable td {
    color: #fff;
    vertical-align: middle;
    text-align: center;
  }
  #eventsTable {
    background-color: #2c3e50;
    border-radius: 10px;
    overflow: hidden;
  }
  #eventsTable thead {
    background-color: black;
    color: white;
  }
  #eventsTable tbody tr:hover {
    background-color: #34495e;
  }
  .btn {
    border-radius: 20px;
    padding: 4px 10px;
  }
  .btn-primary { background-color: #3498db; border: none; }
  .btn-danger  { background-color: #e74c3c; border: none; }
  .pagination .page-item .page-link {
    color: #1abc9c; border: 1px solid #1abc9c; margin: 0 2px;
  }
  .pagination .page-item.active .page-link {
    background-color: #1abc9c; color: white; border: 1px solid #1abc9c;
  }
  @media screen and (max-width: 768px) {
    #eventsTable td, #eventsTable th { font-size: 12px; padding: 8px; }
    .btn { font-size: 12px; padding: 3px 6px; }
  }
</style>

<main id="content">

<?php
$msg = $session->getFlashMessage();
?>

<?php if($msg): ?>

<div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong><?= $msg['type'] ?></strong> <?= $msg['message'] ?>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>

<?php endif; ?>

  <nav aria-label="breadcrumb" class="mt-5">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="admin_dashboard.php">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">Booked Event Reports</li>
    </ol>
  </nav>

  <div class="row mb-3">
    <div class="col-md-4">
      <input type="text" id="searchInput" class="form-control" placeholder="Search ">
    </div>
  </div>

  <div class="container mt-4">
    <div class="table-responsive">
      <table class="table table-bordered table-striped" id="eventsTable">
        <thead>
          <tr>
            <th>#</th>
            <th>User Name</th>
            <th>Events</th>
            <th>Method</th>
            <th>Status</th>
            <th>Amount</th>
            <th>Refund</th>
            <th>Date</th>
          </tr>
        </thead>
        <tbody id="table-data">
          <?php foreach ($result as $index => $row): ?>
            <?php
              $eventsIds = json_decode($row['event_ids'], true);
              $count = $eventsIds[0]['count'];
              $userId = $row['user_id'];
              $userDetails = $conn->prepare("SELECT * FROM login WHERE id = ?");
              $userDetails->execute([$userId]);
              $userDetailsRes = $userDetails->fetch();
              $usersName = $userDetailsRes['name'];
            ?>
            <tr>
              <td><?= $index + 1 ?></td>
              <td><?= htmlspecialchars($usersName) ?></td>
              <td>
                <?php
                  foreach ($eventsIds as $ids) {
                    $eventId = $ids['event_id'];
                    $eventName = $conn->prepare("SELECT type FROM upcomingEvents WHERE id = ?");
                    $eventName->execute([$eventId]);
                    $eventNameRes = $eventName->fetch();
                    echo htmlspecialchars($eventNameRes['type']) . " -- quantity -- " . $count . "<br>";
                  }
                ?>
              </td>
              <td><?= htmlspecialchars($row['method']) ?></td>
              <td><?= htmlspecialchars($row['status']) ?></td>
              <td><?= htmlspecialchars($row['amount'] / 100) ?></td>
              <td>
                <!-- Refund Button triggers modal -->
                <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#refundModal<?= $row['id'] ?>">
                  <i class="fas fa-undo"></i>
                </button>
              </td>
              <td><?= htmlspecialchars($row['created_at']) ?></td>
            </tr>

            <!-- Refund Modal -->
            <div class="modal fade" id="refundModal<?= $row['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="refundModalLabel<?= $row['id'] ?>" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <form action="refund.php" method="POST" onsubmit="return confirm('Are you sure you want to refund this payment?');">
                  <input type="hidden" name="event_id" value="<?= htmlspecialchars($row['id']) ?>">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="refundModalLabel<?= $row['id'] ?>">Refund Reason</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span>&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div class="form-group">
                        <label for="reason">Enter reason for refund:</label>
                        <textarea name="reason" class="form-control" required placeholder="E.g., User requested, duplicate payment, etc."></textarea>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-danger">Submit Refund</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>

  <!-- Pagination controls -->
  <div class="d-flex justify-content-center mt-3">
    <nav>
      <ul class="pagination" id="pagination"></ul>
    </nav>
  </div>
</main>

<!-- Required JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Bootstrap 4 & Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
  $(document).ready(function () {
    let rowsPerPage = 5;
    let rows = $('#table-data tr');
    let pagination = $('#pagination');
    let currentPage = 1;

    function getVisibleRows() {
      return $('#table-data tr:visible');
    }

    function showPage(page) {
      let visibleRows = getVisibleRows();
      let start = (page - 1) * rowsPerPage;
      let end = start + rowsPerPage;
      visibleRows.hide().slice(start, end).show();
    }

    function renderPagination() {
      let visibleRows = getVisibleRows();
      let rowsCount = visibleRows.length;
      let pageCount = Math.ceil(rowsCount / rowsPerPage);

      pagination.empty();

      pagination.append(`<li class="page-item ${currentPage === 1 ? 'disabled' : ''}">
        <a class="page-link" href="#" id="prevPage">Previous</a>
      </li>`);

      for (let i = 1; i <= pageCount; i++) {
        pagination.append(`<li class="page-item ${i === currentPage ? 'active' : ''}">
          <a class="page-link page-num" href="#">${i}</a>
        </li>`);
      }

      pagination.append(`<li class="page-item ${currentPage === pageCount ? 'disabled' : ''}">
        <a class="page-link" href="#" id="nextPage">Next</a>
      </li>`);
    }

    function updateTable() {
      currentPage = 1;
      showPage(currentPage);
      renderPagination();
    }

    updateTable();

    pagination.on('click', '.page-num', function (e) {
      e.preventDefault();
      currentPage = parseInt($(this).text());
      showPage(currentPage);
      renderPagination();
    });

    pagination.on('click', '#prevPage', function (e) {
      e.preventDefault();
      if (currentPage > 1) {
        currentPage--;
        showPage(currentPage);
        renderPagination();
      }
    });

    pagination.on('click', '#nextPage', function (e) {
      e.preventDefault();
      let pageCount = Math.ceil(getVisibleRows().length / rowsPerPage);
      if (currentPage < pageCount) {
        currentPage++;
        showPage(currentPage);
        renderPagination();
      }
    });

    $('#searchInput').on('keyup', function () {
      var value = $(this).val().toLowerCase();
      $('#table-data tr').filter(function () {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
      });
      updateTable();
    });
  });
</script>

<?php include 'layouts/dashboardfooter.php'; ?>
