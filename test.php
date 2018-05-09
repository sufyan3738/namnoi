<table class="table table-bordered">
    		    <thead>
					<tr>
						<th>ชื่อสินค้า</th>
                        <th>จำนวน</th>
                        <th>วันที่ส่งสินค้า</th>
                        <th>เลขที่พัสดุ</th>
					</tr>
				 </thead>
				 <?php
				 $total = 0;
				 	$viewpsql = "SELECT product.*,orders_list.* FROM product,orders_list WHERE product.p_id = orders_list.p_id AND orders_list.o_id = '".$_GET["OrderID"]."'";
					 $viewpquery = mysqli_query($con,$viewpsql);
					 while ($viewpresult = mysqli_fetch_array($viewpquery)) {
						$total = $viewpresult["p_amount"] * $viewpresult["Qty"];
						 ?>
							<tbody>
								<tr>
									<td><?php echo $viewpresult["p_name"]?></td>
									<td><?php echo $viewpresult["Qty"]?></td>
									<td><?php echo $viewpresult["send_date"]?></td>
									<td><?php echo $viewpresult["track_id"]?></td>
								</tr>
							</tbody>
						 <?php
					 }
				 ?>
            </table>