<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Students Manager</title>
    <link rel="stylesheet" href="/css/main.css?v=1.0.3">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  </head>
  <body>
    <div class="container">

      <aside class="sidebar-container">
        <section class="profile">
          <div class="profile-pic"></div>
          <h2 class="username">Admin</h2>
        </section>
        <nav class="menu">
          <ul>  
            <li><span class="material-symbols-outlined">dashboard</span><a href="">Dashboard</a></li>
            <li><span class="material-symbols-outlined">school</span><a href="">Students</a></li>
            <li><span class="material-symbols-outlined">business_center</span><a href="">Teachers</a></li>
            <li><span class="material-symbols-outlined">manage_history</span><a href="">Logs</a></li>
          </ul>
        </nav>
        <footer class="logout">
          <span class="material-symbols-outlined">logout</span>
          <a href="/logout"><h3>Logout</h3></a>
        </footer>
      </aside>

      <main class="content-container">  
          {{content}}
      </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
  <script src="/js/main.js"></script>
</html>