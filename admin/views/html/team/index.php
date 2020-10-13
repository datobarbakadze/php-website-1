<?php $team =  $theClass->list_team(); ?>
<a href="/admin/team/add" class="high_font add_tour_main">ADD TEAM</a>
<table class="list_cont">
	<tbody>
	<thead>
		<td>image</td>
		<td>name</td>
		<td>mark best</td>
		<td>action</td>
	</thead>
	<?php foreach ($team as $info) { ?>
		<tr id="#team_<?php echo $info['id'] ?>">
			<td><img src="<?php echo "../images_team/".$info['image'] ?>" height="40px"></td>
			<td><?php echo $info['f_name'].$info['l_name'] ?></td>
			<td><label class="container_check">
			  <input type="checkbox" name="best_team_check" <?php $theClass->bestTeamExist($info['id']); ?> class="best_team_check" data-id="<?php echo $info['id'] ?>" >
			  <span class="checkmark_check"></span>
			</label></td>
			<td>
				<a href="/admin/team/update/<?php echo $info['id'] ?>"><i class="fa fa-refresh" style="color:white;"></i></a>
				<i class="fa fa-times deleteTeam" data-id="<?php echo $info['id'] ?>" style="color:white;"></i>
			</td>
		</tr>
	<?php } ?>
</tbody></table>