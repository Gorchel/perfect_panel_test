<table class="table table-bordered">
	<thead>
    <tr>
      <th>ID</th>
      <th>User</th>
      <th>Link</th>
      <th>Quantity</th>
      <th class="dropdown-th">
        <div class="dropdown">
          <button class="btn btn-th btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
            Service
            <span class="caret"></span>
          </button>
          <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
            <li class="active"><a href="">All (894931)</a></li>
            <li><a href=""><span class="label-id">214</span>  Real Views</a></li>
            <li><a href=""><span class="label-id">215</span> Page Likes</a></li>
            <li><a href=""><span class="label-id">10</span> Page Likes</a></li>
            <li><a href=""><span class="label-id">217</span> Page Likes</a></li>
            <li><a href=""><span class="label-id">221</span> Followers</a></li>
            <li><a href=""><span class="label-id">224</span> Groups Join</a></li>
            <li><a href=""><span class="label-id">230</span> Website Likes</a></li>
          </ul>
        </div>
      </th>
      <th>Status</th>
      <th class="dropdown-th">
        <div class="dropdown">
          <button class="btn btn-th btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
            Mode
            <span class="caret"></span>
          </button>
          <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
            <li class="active"><a href="">All</a></li>
            <li><a href="">Manual</a></li>
            <li><a href="">Auto</a></li>
          </ul>
        </div>
      </th>
      <th>Created</th>
    </tr>
    </thead>
    <tbody>
    	<?php
    		if (!empty($ordersPaginationArray['orders'])) {
    			foreach ($ordersPaginationArray['orders'] as $order) {
    	?>
    		<tr>
    			<td><?php echo $order->id ?></td>
    			<td><?php echo $order->users->first_name.' '.$order->users->last_name ?></td>
    			<td><a href="<?php echo $order->link ?>" target='_blank'><?php echo $order->link ?></a></td>
    			<td><?php echo $order->quantity ?></td>
    			<td>
    				<span class="label-id"><?php echo $order->services->id ?></span>
    				<?php echo $order->services->name ?>	
				</td>
				<td><?php echo $order->statusName ?></td>
				<td><?php echo $order->modeName ?></td>
				<td><?php echo $order->humanCreatedAt ?></td>
    		</tr>
    	<?php
    			}
    		} else {
    			echo '<tr><td colpan="99">Orders not found</td></tr>';
    		}
    	?>
    </tbody>
</table>