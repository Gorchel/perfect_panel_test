<table class="table table-bordered">
	<thead>
    <tr>
      <th>ID</th>
      <th>User</th>
      <th>Link</th>
      <th>Quantity</th>
      <th class="dropdown-th">
          <?= $this->render('services/services_select', [
              'servicesList' => $servicesList
          ]); ?>
      </th>
      <th>Status</th>
      <th class="dropdown-th">
          <?= $this->render('mode/mode_select'); ?>
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