<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="../styles.css">
  <title>Restaurantes</title>
</head>
<body>
  <header>
    <h1>🍽️ Restaurantes</h1>
    <nav>
      <a href="../index.html" class="btn">Inicio</a>
      <a href="../lugares/lugares.php" class="btn">Lugares</a>
      <a href="../clima/clima.php" class="btn">Clima</a>
    </nav>
  </header>

  <main>
    <button class="btn-new" onclick="window.location='restaurantes-nuevo.php'">➕ Nuevo Restaurante</button>

    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Nombre</th>
          <th>Dirección</th>
          <th>Tipo de Comida</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody id="tabla-restaurantes"></tbody>
    </table>
  </main>

  <script>
    const API_URL = "http://localhost:8000/restaurantes";

    async function cargarRestaurantes() {
      const res = await fetch(API_URL);
      const data = await res.json();
      const tbody = document.getElementById("tabla-restaurantes");
      tbody.innerHTML = data.map(r => `
        <tr>
          <td>${r.id}</td>
          <td>${r.nombre}</td>
          <td>${r.direccion}</td>
          <td>${r.tipo_comida}</td>
          <td class="actions">
            <button class="btn-edit" onclick="editar(${r.id})">Editar</button>
            <button class="btn-delete" onclick="eliminar(${r.id})">Eliminar</button>
          </td>
        </tr>
      `).join('');
    }

    function editar(id) {
      window.location = `restaurantes-editar.php?id=${id}`;
    }

    async function eliminar(id) {
      if (!confirm("¿Seguro de eliminar este restaurante?")) return;
      await fetch(`${API_URL}/${id}`, { method: "DELETE" });
      cargarRestaurantes();
    }

    cargarRestaurantes();
  </script>
</body>
</html>
