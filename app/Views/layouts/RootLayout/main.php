<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Students Manager</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/main.css">
  </head>
  <body>
    <div class="outer-container">
      <div class="sidebar-container">
        <div class="profile-section">
          <img src="https://www.flaticon.com/free-icon/admin_9703596" alt="admin-profile">
          <h2 class="username">Admin</h2>
        </div>
        <div class="tab-container">
          <ul>
            <a href="/students"><li>Student Credentials</li></a>
            <a href="/grades"><li>Student Grades</li></a>
          </ul>
        </div>
        <div class="logout-container"></div>
      </div>
      <div class="content-container">
          {{content}}
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
  <script src="/js/main.js"></script>
</html>