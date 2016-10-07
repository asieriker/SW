<?php

$link= mysqli_connect("localhost", "root","", "Quiz");

$usuarios = mysqli_query($link, "select * from usuario" );
echo '<table border=1> <tr> <th> Nombre y Apellidos </th> <th> Correo </th> <th> Imagen</th>
</tr>';

while ($row = mysqli_fetch_array( $usuarios )) {
	
echo '<tr><td>' . $row['NombreApellidos'] . '</td> <td>' . $row['Correo'] . '</td>
 <td> <div><img src="'.$row['ruta'].'" width="180px" height="214px"/></div></td></tr>';
}

echo '</table>';
$usuarios->close(); //poner notacion no OO
mysqli_close($link);

?>