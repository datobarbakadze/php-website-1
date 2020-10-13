<h2 style="text-align: center;">Reviews manager</h2>
<ul class="nav nav-pills nav-justified red">
    <li class="active"><a data-toggle="pill" href="#hold">On hold</a></li>
    <li><a data-toggle="pill" href="#accepted">Accepted</a></li>
    <li><a data-toggle="pill" href="#deleted">Deleted</a></li>
</ul>
<div class="tab-content">
	<div id="hold" class="tab-pane fade in active">
		<table class="table">	
			<thead>
				<tr>
					<td>name</td>
					<td>rating</td>
					<td>review</td>
					<td>registered</td>
					<td>bought</td>
					<td>action</td>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($obj->reviews(3) as $review): ?>
					<tr id="single_review-<?php echo $review['id'] ?>">
						<td><?php echo $review['name'] ?></td>
						<td><?php echo $review['rating'] ?></td>
						<td><?php echo $review['review'] ?></td>
						<td><?php echo $review['registered'] ?></td>
						<td><?php echo $review['bought'] ?></td>
						<td style="width:100px;">
							<i data-review-id="<?php echo $review['id'] ?>" data-status-id="1" data-object-class="single-review" class="review_admin fa fa-check"></i>
							<i data-review-id="<?php echo $review['id'] ?>" data-status-id="2" data-object-class="single-review" class="review_admin fa fa-times"></i>
						</td>
					</tr>
				<?php endforeach ?>
				
			</tbody>
		</table>
	</div>
	<div id="accepted" class="tab-pane fade">
		<table class="table">	
			<thead>
				<tr>
					<td>name</td>
					<td>rating</td>
					<td>review</td>
					<td>registered</td>
					<td>bought</td>
					<td>action</td>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($obj->reviews(1) as $review): ?>
					<tr id="single_review-<?php echo $review['id'] ?>">
						<td><?php echo $review['name'] ?></td>
						<td><?php echo $review['rating'] ?></td>
						<td><?php echo $review['review'] ?></td>
						<td><?php echo $review['registered'] ?></td>
						<td><?php echo $review['bought'] ?></td>
						<td style="width:100px;">
							<i data-review-id="<?php echo $review['id'] ?>" data-status-id="2" data-object-class="single-review" class="review_admin fa fa-times"></i>
							<i data-review-id="<?php echo $review['id'] ?>" data-status-id="3" data-object-class="single-review" class="review_admin fa fa-refresh"></i>
						</td>
					</tr>
				<?php endforeach ?>
				
			</tbody>
		</table>
	</div>

	<div id="deleted" class="tab-pane fade">
		<table class="table">	
			<thead>
				<tr>
					<td>name</td>
					<td>rating</td>
					<td>review</td>
					<td>registered</td>
					<td>bought</td>
					<td>action</td>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($obj->reviews(2) as $review): ?>
					<tr id="single_review-<?php echo $review['id'] ?>">
						<td><?php echo $review['name'] ?></td>
						<td><?php echo $review['rating'] ?></td>
						<td><?php echo $review['review'] ?></td>
						<td><?php echo $review['registered'] ?></td>
						<td><?php echo $review['bought'] ?></td>
						<td style="width:100px;">
							<i data-review-id="<?php echo $review['id'] ?>" data-status-id="1" data-object-class="single-review" class="review_admin fa fa-check"></i>
							<i data-review-id="<?php echo $review['id'] ?>" data-status-id="3" data-object-class="single-review" class="review_admin fa fa-refresh"></i>
						</td>
					</tr>
				<?php endforeach ?>
			</tbody>
		</table>
	</div>
</div>

