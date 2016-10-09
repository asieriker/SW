<?php

$link= mysqli_connect("localhost", "root","", "Quiz");

$usuarios = mysqli_query($link, "select * from usuario" );
echo '<table border=1> <tr> <th> Nombre y Apellidos </th> <th> Correo </th> <th> Contraseña </th> 
<th> Telefono </th> <th> Especialidad </th> <th> Intereses </th> <th> Imagen </th>
</tr>';

while ($row = mysqli_fetch_array( $usuarios )) {
echo '<tr><td>' . $row['NombreApellidos'] . '</td> <td>' . $row['Correo'] . '</td> <td>' . $row['Contrasena'] . '</td> 
<td>' . $row['NTelefono'] . '</td> <td>' . $row['Especialidad'] . '</td> <td>' . $row['Intereses'] . '</td>
 <td> <div><img src="'.$row['ruta'].'" width="180px" height="214px"/></div></td></tr>';
}

echo '</table>';
$usuarios->close(); //poner notacion no OO
mysqli_close($link);

?>