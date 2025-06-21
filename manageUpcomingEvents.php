<?php
include 'layouts/dashboardheader.php';
$role = $_SESSION['role'];
if ($role !== 'admin') {
    redirect("logout.php");
}


$getAllUpcomingEvents = $conn->prepare("SELECT * FROM upcomingEvents ORDER BY id DESC");
$getAllUpcomingEvents->execute();
$result = $getAllUpcomingEvents->fetchAll();
?>
<style>
  #eventsTable th, 
  #eventsTable td {
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

  .btn-primary {
    background-color: #3498db;
    border: none;
  }

  .btn-danger {
    background-color: #e74c3c;
    border: none;
  }

  .pagination .page-item .page-link {
    color: #1abc9c;
    border: 1px solid #1abc9c;
    margin: 0 2px;
  }

  .pagination .page-item.active .page-link {
    background-color: #1abc9c;
    color: white;
    border: 1px solid #1abc9c;
  }

  @media screen and (max-width: 768px) {
    #eventsTable td,
    #eventsTable th {
      font-size: 12px;
      padding: 8px;
    }

    .btn {
      font-size: 12px;
      padding: 3px 6px;
    }
  }
</style>


<main id="content">
  <nav aria-label="breadcrumb" class="mt-5">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="admin_dashboard.php">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">Manage Events</li>
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
        <th>Type</th>
        <th>Level</th>
        <th>ImageUrl</th>
        <th>Contact</th>
        <th>Special</th>
        <th>State</th>
        <th>City</th>
        <th>Time</th>
        <th>Date</th>
        <th>Slot</th>
        <th>Place</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody id="table-data">
      <?php foreach ($result as $index => $row): ?>
        <tr>
          <td><?= $index + 1 ?></td>
          <td><?= htmlspecialchars($row['type']) ?></td>
          <td><?= htmlspecialchars($row['level']) ?></td>
          <td>
            <?php if (!empty($row['imageUrl'])): ?>
              <img src="<?= htmlspecialchars($row['imageUrl']) ?>" alt="Event" style="width: 60px; height: auto; border-radius: 5px;">
            <?php else: ?>
              No Image
            <?php endif; ?>
          </td>

          <td><?= htmlspecialchars($row['contact']) ?></td>
          <td><?= $row['isSpecialEvent'] == 1? "Yes" : "No" ?></td>
          <td><?= htmlspecialchars($row['state']) ?></td>
          <td><?= htmlspecialchars($row['city']) ?></td>
          <td><?= htmlspecialchars($row['time']) ?></td>
          <td><?= htmlspecialchars($row['date']) ?></td>
          <td><?= htmlspecialchars($row['slot']) ?></td>
          <td><?= htmlspecialchars($row['addPlace']) ?></td>
          <td>
            <div class="d-flex">
                <a href="edit_events.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-primary " title="Edit">
                <i class="fas fa-edit"></i>
                </a>
                <a href="delete_events.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger ml-2" title="Delete" onclick="return confirm('Are you sure you want to delete this event?');">
                <i class="fas fa-trash-alt"></i>
                </a>
            </div>
          </td>

        </tr>

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

</div>
</main>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
