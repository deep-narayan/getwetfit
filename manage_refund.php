<?php
include 'layouts/dashboardheader.php';
$role = $_SESSION['role'];
if ($role !== 'admin') {
    redirect("logout.php");
}

$getAllRefund = $conn->prepare("SELECT * FROM refunds ORDER BY id DESC");
$getAllRefund->execute();
$result = $getAllRefund->fetchAll();
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

  <nav aria-label="breadcrumb" class="mt-5">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="admin_dashboard.php">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">Refund Reports</li>
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
            <th>Amount</th>
            <th>Status</th>
            <th>Reason</th>
            <th>User Name</th>
            <th>Date</th>
            <th>Status</th>
            <th>Amount</th>
            <th>Check</th>
          </tr>
        </thead>
        <tbody id="table-data">
          <?php foreach ($result as $index => $row): ?>
            <?php
              $userId = $row['refunded_at'];
              $userDetails = $conn->prepare("SELECT * FROM login WHERE id = ?");
              $userDetails->execute([$userId]);
              $userDetailsRes = $userDetails->fetch();
              $usersName = $userDetailsRes['name'];
            ?>
            <tr>
              <td><?= $index + 1 ?></td>
              <td><?= htmlspecialchars($row['amount']) ?></td>
              <td><?= htmlspecialchars($row['status']) ?></td>
              <td><?= htmlspecialchars($row['reason']) ?></td>
              <td><?= htmlspecialchars($usersName) ?></td>
              <td><?= htmlspecialchars($row['date']) ?></td>
              
              <td><?= htmlspecialchars($row['status']) ?></td>
              <td><?= htmlspecialchars($row['amount']) ?></td>
              <td>
                <form action="refund_status.php" method="POST" class="d-inline">
                    <input type="hidden" name="event_id" value="<?= htmlspecialchars($row['refund_id']) ?>">
                    <button type="submit" class="btn btn-sm btn-info" title="Check refund status">
                    <i class="fas fa-search"></i> Check
                    </button>
                </form>
                </td>

            </tr>
              </div>
            </div>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>

  <!-- Pagination controls -->
<div class="d-flex justify-content-center align-items-center p-2 mt-3">
  <button class="btn btn-primary mr-2" id="prevBtn">Previous</button>
  <span id="pageInfo" class="mx-2 text-white">Page 1 of X</span>
  <button class="btn btn-primary ml-2" id="nextBtn">Next</button>
</div>
</main>

<!-- Required JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Bootstrap 4 & Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
  $(document).ready(function () {
    let rowsPerPage = 2;
    let currentPage = 1;

    function getFilteredRows() {
      let value = $('#searchInput').val().toLowerCase();
      return $('#table-data tr').filter(function () {
        let match = $(this).text().toLowerCase().indexOf(value) > -1;
        $(this).toggle(match);
        return match;
      });
    }

    function showPage(page) {
      let filteredRows = getFilteredRows();
      let totalPages = Math.ceil(filteredRows.length / rowsPerPage);

      filteredRows.hide();
      filteredRows.slice((page - 1) * rowsPerPage, page * rowsPerPage).show();

      $('#pageInfo').text('Page ' + page + ' of ' + (totalPages || 1));
      $('#prevBtn').prop('disabled', page <= 1);
      $('#nextBtn').prop('disabled', page >= totalPages);

      return totalPages;
    }

    // Initial load
    showPage(currentPage);

    $('#searchInput').on('keyup', function () {
      currentPage = 1;
      showPage(currentPage);
    });

    $('#prevBtn').click(function () {
      if (currentPage > 1) {
        currentPage--;
        showPage(currentPage);
      }
    });

    $('#nextBtn').click(function () {
      let totalPages = showPage(currentPage); // recalc based on current filter
      if (currentPage < totalPages) {
        currentPage++;
        showPage(currentPage);
      }
    });
  });
</script>

<?php include 'layouts/dashboardfooter.php'; ?>
