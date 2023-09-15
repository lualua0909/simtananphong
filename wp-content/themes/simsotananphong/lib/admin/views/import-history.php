<?php
$args = [
	'post_type'      => 'import_history',
	'posts_per_page' => - 1,
	'post_status'    => ['publish'],
];

$loop = new WP_Query($args);

?>

<div class="wrap">
	<h2>Lịch sử nhập</h2>
	<table class="widefat striped" id="sim-report-table">
		<thead>
		<tr>
			<th scope="col">Tên file</th>
			<th scope="col">Thời gian</th>
			<th scope="col">Số lượng</th>
			<th scope="col">Hành động</th>
		</tr>
		</thead>
		<tbody id="the-list">
		<?php if ($loop->have_posts()):
			while ($loop->have_posts()) : $loop->the_post();
				$post_id   = get_the_ID();
				$file_name = get_post_meta($post_id, '_file_name', true);
				$date      = get_the_date('d/m/Y H:i:s');

				?>
				<tr>
					<td><?= $file_name ?></td>
					<td><?= $date ?></td>
					<td><?= _n_count_import($post_id) ?></td>
					<td><a class="delete-product-by-history" href="javascript:;" data-history="<?= $post_id ?>">Xoá</a></td>
				</tr>
			<?php endwhile;
			wp_reset_postdata();
		else: ?>
			<tr>
				<td colspan="4">Không có dữ liệu</td>
			</tr>
		<?php endif; ?>
		</tbody>
	</table>
</div>
