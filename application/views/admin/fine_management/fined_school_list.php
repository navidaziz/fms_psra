<?php
$count = 1;
$query = "SELECT fs.fined_school_id, fs.school_id, fs.school_name, fs.district_name, fs.tehsil_name, fs.address ,
								SUM(IF(f.status=1,1,0)) as density,
								SUM(IF(f.status=1,f.fine_amount,0)) as total_fine,
								SUM(IF(f.status=3,1,0)) as w_offed,
								(SELECT SUM(fy.deposit_amount) FROM fine_payments as fy WHERE fy.is_deleted=0 AND fy.fined_school_id = fs.fined_school_id ) as paid_amount
	                            FROM fines as f
								INNER JOIN fined_schools fs ON (fs.fined_school_id = f.fined_school_id)
								GROUP BY f.fined_school_id
								";
$fines = $this->db->query($query)->result();
foreach ($fines as $fine) {
?>
    <tr>
        <td><?php echo $count++; ?></td>
        <td><?php echo $fine->school_id; ?></td>
        <td><?php echo $fine->school_name; ?></td>
        <td><?php echo $fine->district_name; ?></td>
        <td><?php echo $fine->tehsil_name; ?></td>
        <td><?php echo $fine->address; ?></td>
        <td><?php echo $fine->density; ?></td>
        <td><?php echo $fine->total_fine; ?></td>
        <td><?php echo $fine->w_offed; ?></td>
        <td><?php echo $fine->paid_amount; ?></td>
        <td><?php echo $fine->total_fine - $fine->paid_amount; ?></td>
        <td>
            <button onclick="get_add_fine_payment_form('<?php echo $fine->fined_school_id; ?>')" class="btn btn-link btn-sm">
                View
            </button>
            <a href="<?php echo site_url(ADMIN_DIR . "fine_management/view_fine_detail/" . $fine->fined_school_id); ?>">
                View
            </a>
        </td>
    </tr>
<?php } ?>