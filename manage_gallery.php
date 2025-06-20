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
<div class="d-flex justify-content-center mt-3">
  <nav>
    <ul class="pagination" id="pagination"></ul>
  </nav>
</div>

</div>
</main>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function () {
    let rowsPerPage = 5;
    let rows = $('#table-data tr');
    let rowsCount = rows.length;
    let pageCount = Math.ceil(rowsCount / rowsPerPage);
    let pagination = $('#pagination');
    let currentPage = 1;

    function showPage(page) {
      let start = (page - 1) * rowsPerPage;
      let end = start + rowsPerPage;
      rows.hide().slice(start, end).show();
    }

    function renderPagination() {
      pagination.empty();

      // Previous button
      pagination.append(`<li class="page-item ${currentPage === 1 ? 'disabled' : ''}">
        <a class="page-link" href="#" id="prevPage">Previous</a>
      </li>`);

      // Page numbers
      for (let i = 1; i <= pageCount; i++) {
        pagination.append(`<li class="page-item ${i === currentPage ? 'active' : ''}">
          <a class="page-link page-num" href="#">${i}</a>
        </li>`);
      }

      // Next button
      pagination.append(`<li class="page-item ${currentPage === pageCount ? 'disabled' : ''}">
        <a class="page-link" href="#" id="nextPage">Next</a>
      </li>`);
    }

    // Initial render
    showPage(currentPage);
    renderPagination();

    // Handle page number click
    pagination.on('click', '.page-num', function (e) {
      e.preventDefault();
      currentPage = parseInt($(this).text());
      showPage(currentPage);
      renderPagination();
    });

    // Handle previous click
    pagination.on('click', '#prevPage', function (e) {
      e.preventDefault();
      if (currentPage > 1) {
        currentPage--;
        showPage(currentPage);
        renderPagination();
      }
    });

    // Handle next click
    pagination.on('click', '#nextPage', function (e) {
      e.preventDefault();
      if (currentPage < pageCount) {
        currentPage++;
        showPage(currentPage);
        renderPagination();
      }
    });
  });
</script>


<?php include 'layouts/dashboardfooter.php'; ?>
