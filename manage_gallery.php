<?php
include 'layouts/dashboardheader.php';
$role = $_SESSION['role'];
if ($role !== 'admin') {
    redirect("logout.php");
}


$getAllUpcomingEvents = $conn->prepare("SELECT * FROM galleryurl ORDER BY id DESC");
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
    background-color: black;
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
    <li class="breadcrumb-item active" aria-current="page">Manage Gallery</li>
  </ol>
</nav>
<div class="container mt-4">

  <div class="table-responsive">
  <table class="table table-bordered table-striped" id="eventsTable">
    <thead>
      <tr>
        <th>#</th>
        <th>Type</th>
        <th>ImageUrl</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody id="table-data">
      <?php foreach ($result as $index => $row): ?>
        <tr>
          <td><?= $index + 1 ?></td>
          <td><?= htmlspecialchars($row['sessionType']) ?></td>
          <td>
            <?php if (!empty($row['imgURL'])): ?>
              <img src="<?= htmlspecialchars($row['imgURL']) ?>" alt="Event" style="width: 60px; height: auto; border-radius: 5px;">
            <?php else: ?>
              No Image
            <?php endif; ?>
          </td>
          <td>
            <div class="d-flex">
                <a href="edit_gallery.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-primary " title="Edit">
                <i class="fas fa-edit"></i>
                </a>
                <a href="delete_gallery.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger ml-2" title="Delete" onclick="return confirm('Are you sure you want to delete this event?');">
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
    let rows = $('#table-data tr');
    let totalPages = Math.ceil(rows.length / rowsPerPage);
    let currentPage = 1;

    function showPage(page) {
      rows.hide();
      rows.slice((page - 1) * rowsPerPage, page * rowsPerPage).show();
      $('#pageInfo').text('Page ' + page + ' of ' + totalPages);
    }

    function toggleButtons() {
      $('#prevBtn').prop('disabled', currentPage === 1);
      $('#nextBtn').prop('disabled', currentPage === totalPages);
    }

    showPage(currentPage);
    toggleButtons();

    $('#prevBtn').click(function () {
      if (currentPage > 1) {
        currentPage--;
        showPage(currentPage);
        toggleButtons();
      }
    });

    $('#nextBtn').click(function () {
      if (currentPage < totalPages) {
        currentPage++;
        showPage(currentPage);
        toggleButtons();
      }
    });
  });
</script>


<?php include 'layouts/dashboardfooter.php'; ?>
