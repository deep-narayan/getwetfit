<?php
include 'layouts/dashboardheader.php';
$role = $_SESSION['role'];
if ($role !== 'admin') {
    redirect("logout.php");
}


$getAllInquiries = $conn->prepare("SELECT * FROM contactusform ORDER BY id DESC");
$getAllInquiries->execute();
$result = $getAllInquiries->fetchAll();
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
        <li class="breadcrumb-item active" aria-current="page">Users Inquiries</li>
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
        <th>Name</th>
        <th>Contact</th>
        <th>Email</th>
        <th>Age</th>
        <th>Gender</th>
        <th>Height</th>
        <th>Do you know how to swim</th>
        <th>Join us as</th>
        <th>Location</th>
        <th>Message Query</th>
      </tr>
    </thead>
    <tbody id="table-data">
      <?php foreach ($result as $index => $row): ?>
        <tr>
          <td><?= $index + 1 ?></td>
          <td><?= htmlspecialchars($row['fullName']) ?></td>
          <td><?= htmlspecialchars($row['phoneNumber']) ?></td>
          <td><?= htmlspecialchars($row['email']) ?></td>
          <td><?= htmlspecialchars($row['age']) ?></td>
          <td><?= htmlspecialchars($row['gender']) ?></td>
          <td><?= htmlspecialchars($row['height']) ?></td>
          <td><?= htmlspecialchars($row['doYouKnowHowToSwim']) ?></td>
          <td><?= htmlspecialchars($row['joinUsAs']) ?></td>
          <td><?= htmlspecialchars($row['location']) ?></td>
          <td><?= htmlspecialchars($row['message_query']) ?></td>
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
