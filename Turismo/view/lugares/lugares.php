<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="../styles.css">
  <title>Lugares Turísticos</title>
</head>
<body>
  <header>
    <h1>🏖️ Lugares Turísticos</h1>
    <nav>
      <a href="../index.html" class="btn">Inicio</a>
      <a href="../restaurantes/restaurantes.php" class="btn">Restaurantes</a>
      <a href="../clima/clima.php" class="btn">Clima</a>
    </nav>
  </header>

  <main>
    <button class="btn-new" onclick="window.location='lugares-nuevo.php'">➕ Nuevo Lugar</button>

    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Nombre</th>
          <th>Descripción</th>
          <th>Ubicación</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody id="tabla-lugares"></tbody>
    </table>
  </main>

  <script>
    const API_URL = "http://localhost:8000/lugares";

    async function cargarLugares() {
      const res = await fetch(API_URL);
      const lugares = await res.json();
      const tbody = document.getElementById("tabla-lugares");
      tbody.innerHTML = lugares.map(l => `
        <tr>
          <td>${l.id}</td>
          <td>${l.nombre}</td>
          <td>${l.descripcion}</td>
          <td>${l.ubicacion}</td>
          <td class="actions">
            <button class="btn-edit" onclick="editar(${l.id})">Editar</button>
            <button class="btn-delete" onclick="eliminar(${l.id})">Eliminar</button>
          </td>
        </tr>
      `).join('');
    }

    async function eliminar(id) {
      if (!confirm("¿Seguro de eliminar este lugar?")) return;
      await fetch(`${API_URL}/${id}`, { method: "DELETE" });
      cargarLugares();
    }

    function editar(id) {
      window.location = `lugares-editar.php?id=${id}`;
    }

    cargarLugares();
  </script>
</body>
</html>
