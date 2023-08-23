<?php
	include("../../configuration.php");
	include("../../connection.php");

	$sql = "select * from
			(select a.slnoso, a.sltglso, a.slkdcust, a.slkdbrand, a.slnopo, a.slsub_total
			from kmsoh a
			where a.slnopo = '06fob')dt1
			left join
			(select a.rnomp, a.rnoso, a.rartprod, a.rartcust, a.rkdbrgjd from clemcmp a)dt2
			on dt1.slnoso = dt2.rnoso where 1";
	$result = mysql_query($sql,$conn);
?>
	<table border="1">
		<thead>
			<tr>
				<th align="center">No</th>
	         <th align="center">No. Sales Order</th>
	         <th align="center">Kode Barang Jadi</th>
	         <th align="center">No. MP</th>
	         <th align="center">33</th>
	         <th align="center">33s</th>
	         <th align="center">34</th>
	         <th align="center">34s</th>
	         <th align="center">35</th>
	         <th align="center">35s</th>
	         <th align="center">36</th>
	         <th align="center">36s</th>
	         <th align="center">37</th>
	         <th align="center">37s</th>
	         <th align="center">38</th>
	         <th align="center">38s</th>
	         <th align="center">39</th>
	         <th align="center">39s</th>
	         <th align="center">40</th>
	         <th align="center">40s</th>
	         <th align="center">41</th>
	         <th align="center">41s</th>
	         <th align="center">42</th>
	         <th align="center">42s</th>
	         <th align="center">43</th>
	         <th align="center">43s</th>
	         <th align="center">44</th>
	         <th align="center">44s</th>
	         <th align="center">Status</th>
			</tr>
		</thead>
		<tbody>
<?php
	$no = 1;
	while ($data = mysql_fetch_array($result)) {
		$slnoso = $data["slnoso"];
		$rkdbrgjd = $data["rkdbrgjd"];
		$rnomp = $data["rnomp"];

		$sql_1 = "select * from kmsod a where a.dnoso = '".$slnoso."'";
		$result_1 = mysql_query($sql_1,$conn);
		$data_1 = mysql_fetch_array($result_1);

		$dord33 = $data_1["dord33"];
		$dord34 = $data_1["dord34"];
		$dord35 = $data_1["dord35"];
		$dord36 = $data_1["dord36"];
		$dord37 = $data_1["dord37"];
		$dord38 = $data_1["dord38"];
		$dord39 = $data_1["dord39"];
		$dord40 = $data_1["dord40"];
		$dord41 = $data_1["dord41"];
		$dord42 = $data_1["dord42"];
		$dord43 = $data_1["dord43"];
		$dord44 = $data_1["dord44"];


		$dord33s = $data_1["dord33s"];
		$dord34s = $data_1["dord34s"];
		$dord35s = $data_1["dord35s"];
		$dord36s = $data_1["dord36s"];
		$dord37s = $data_1["dord37s"];
		$dord38s = $data_1["dord38s"];
		$dord39s = $data_1["dord39s"];
		$dord40s = $data_1["dord40s"];
		$dord41s = $data_1["dord41s"];
		$dord42s = $data_1["dord42s"];
		$dord43s = $data_1["dord43s"];
		$dord44s = $data_1["dord44s"];

		$sql_2 = "select * from clmpdet3 a where a.mpno = '".$rnomp."' and kdbrg = '".$rkdbrgjd."'";
		$result_2 = mysql_query($sql_2,$conn);
		$data_2 = mysql_fetch_array($result_2);

		$d33 = $data_2["d33"];
		$d34 = $data_2["d34"];
		$d35 = $data_2["d35"];
		$d36 = $data_2["d36"];
		$d37 = $data_2["d37"];
		$d38 = $data_2["d38"];
		$d39 = $data_2["d39"];
		$d40 = $data_2["d40"];
		$d41 = $data_2["d41"];
		$d42 = $data_2["d42"];
		$d43 = $data_2["d43"];
		$d44 = $data_2["d44"];

		$d33s = $data_2["d33s"];
		$d34s = $data_2["d34s"];
		$d35s = $data_2["d35s"];
		$d36s = $data_2["d36s"];
		$d37s = $data_2["d37s"];
		$d38s = $data_2["d38s"];
		$d39s = $data_2["d39s"];
		$d40s = $data_2["d40s"];
		$d41s = $data_2["d41s"];
		$d42s = $data_2["d42s"];
		$d43s = $data_2["d43s"];
		$d44s = $data_2["d44s"];

		$status = 0;

		for ($i=32; $i < 44 ; $i++) { 
			if ($data_2[d.$i] != $data_1[dord.$i]) {
			$status = 1;
			break;
			}
			else if ($data_2[d.$i.s] != $data_1[dord.$i.s]) {
			$status = 1;
			break;
			}
		}

		if ($status == 1) {
			$status = "TIDAK OK";
		}
		else{
			$status = "OK";
		}

			echo "<tr>";
				echo "<td rowspan=\"2\">";
					echo $no;
				echo "</td>";
				echo "<td rowspan=\"2\">";
					echo $slnoso;
				echo "</td>";
				echo "<td rowspan=\"2\">";
					echo $rkdbrgjd;
				echo "</td>";
				echo "<td rowspan=\"2\">";
					echo $rnomp;
				echo "</td>";
				echo "<td>";
					echo $dord33;
				echo "</td>";
				echo "<td>";
					echo $dord33s;
				echo "</td>";
				echo "<td>";
					echo $dord34;
				echo "</td>";
				echo "<td>";
					echo $dord34s;
				echo "</td>";
				echo "<td>";
					echo $dord35;
				echo "</td>";
				echo "<td>";
					echo $dord35s;
				echo "</td>";
				echo "<td>";
					echo $dord36;
				echo "</td>";
				echo "<td>";
					echo $dord36s;
				echo "</td>";
				echo "<td>";
					echo $dord37;
				echo "</td>";
				echo "<td>";
					echo $dord37s;
				echo "</td>";
				echo "<td>";
					echo $dord38;
				echo "</td>";
				echo "<td>";
					echo $dord38s;
				echo "</td>";
				echo "<td>";
					echo $dord39;
				echo "</td>";
				echo "<td>";
					echo $dord39s;
				echo "</td>";
				echo "<td>";
					echo $dord40;
				echo "</td>";
				echo "<td>";
					echo $dord40s;
				echo "</td>";
				echo "<td>";
					echo $dord41;
				echo "</td>";
				echo "<td>";
					echo $dord41s;
				echo "</td>";
				echo "<td>";
					echo $dord42;
				echo "</td>";
				echo "<td>";
					echo $dord42s;
				echo "</td>";
				echo "<td>";
					echo $dord43;
				echo "</td>";
				echo "<td>";
					echo $dord43s;
				echo "</td>";
				echo "<td>";
					echo $dord44;
				echo "</td>";
				echo "<td>";
					echo $dord44s;
				echo "</td>";
				echo "<td rowspan=\"2\">";
					echo $status;
				echo "</td>";
			echo "</tr>";
			echo "<tr>";
				echo "<td>";
					echo $d33;
				echo "</td>";
				echo "<td>";
					echo $d33s;
				echo "</td>";
				echo "<td>";
					echo $d34;
				echo "</td>";
				echo "<td>";
					echo $d34s;
				echo "</td>";
				echo "<td>";
					echo $d35;
				echo "</td>";
				echo "<td>";
					echo $d35s;
				echo "</td>";
				echo "<td>";
					echo $d36;
				echo "</td>";
				echo "<td>";
					echo $d36s;
				echo "</td>";
				echo "<td>";
					echo $d37;
				echo "</td>";
				echo "<td>";
					echo $d37s;
				echo "</td>";
				echo "<td>";
					echo $d38;
				echo "</td>";
				echo "<td>";
					echo $d38s;
				echo "</td>";
				echo "<td>";
					echo $d39;
				echo "</td>";
				echo "<td>";
					echo $d39s;
				echo "</td>";
				echo "<td>";
					echo $d40;
				echo "</td>";
				echo "<td>";
					echo $d40s;
				echo "</td>";
				echo "<td>";
					echo $d41;
				echo "</td>";
				echo "<td>";
					echo $d41s;
				echo "</td>";
				echo "<td>";
					echo $d42;
				echo "</td>";
				echo "<td>";
					echo $d42s;
				echo "</td>";
				echo "<td>";
					echo $d43;
				echo "</td>";
				echo "<td>";
					echo $d43s;
				echo "</td>";
				echo "<td>";
					echo $d44;
				echo "</td>";
				echo "<td>";
					echo $d44s;
				echo "</td>";
			echo "</tr>";
		// mysql_free_result($data_1);
		// mysql_free_result($data_2);

			$totdord33 += $dord33;
			$totdord33s += $dord33s;
			$totdord34 += $dord34;
			$totdord34s += $dord34s;
			$totdord35 += $dord35;
			$totdord35s += $dord35s;
			$totdord36 += $dord36;
			$totdord36s += $dord36s;
			$totdord37 += $dord37;
			$totdord37s += $dord37s;
			$totdord38 += $dord38;
			$totdord38s += $dord38s;
			$totdord39 += $dord39;
			$totdord39s += $dord39s;
			$totdord40 += $dord40;
			$totdord40s += $dord40s;
			$totdord41 += $dord41;
			$totdord41s += $dord41s;
			$totdord42 += $dord42;
			$totdord42s += $dord42s;
			$totdord43 += $dord43;
			$totdord43s += $dord43s;
			$totdord44 += $dord44;
			$totdord44s += $dord44s;

			$no++;
	}

	echo "<tr>";
		echo "<td rowspan=\"2\" colspan=\"4\" align=\"center\">";
			echo "TOTAL";
		echo "</td>";
	echo "</tr>";
	echo "<td>";
		echo $totdord33;
	echo "</td>";
	echo "<td>";
		echo $totdord33s;
	echo "</td>";
	echo "<td>";
		echo $totdord34;
	echo "</td>";
	echo "<td>";
		echo $totdord34s;
	echo "</td>";
	echo "<td>";
		echo $totdord35;
	echo "</td>";
	echo "<td>";
		echo $totdord35s;
	echo "</td>";
	echo "<td>";
		echo $totdord36;
	echo "</td>";
	echo "<td>";
		echo $totdord36s;
	echo "</td>";
	echo "<td>";
		echo $totdord37;
	echo "</td>";
	echo "<td>";
		echo $totdord37s;
	echo "</td>";
	echo "<td>";
		echo $totdord38;
	echo "</td>";
	echo "<td>";
		echo $totdord38s;
	echo "</td>";
	echo "<td>";
		echo $totdord39;
	echo "</td>";
	echo "<td>";
		echo $totdord39s;
	echo "</td>";
	echo "<td>";
		echo $totdord40;
	echo "</td>";
	echo "<td>";
		echo $totdord40s;
	echo "</td>";
	echo "<td>";
		echo $totdord41;
	echo "</td>";
	echo "<td>";
		echo $totdord41s;
	echo "</td>";
	echo "<td>";
		echo $totdord42;
	echo "</td>";
	echo "<td>";
		echo $totdord42s;
	echo "</td>";
	echo "<td>";
		echo $totdord43;
	echo "</td>";
	echo "<td>";
		echo $totdord43s;
	echo "</td>";
	echo "<td>";
		echo $totdord44;
	echo "</td>";
	echo "<td>";
		echo $totdord44s;
	echo "</td>";
	echo "<td>";
		echo "";
	echo "</td>";
?>
		</tbody>
	</table>