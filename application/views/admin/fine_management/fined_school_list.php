<?php
// $query = "SELECT fs.fined_school_id, fs.school_id, fs.school_name, fs.district_name, fs.tehsil_name, fs.address ,
// SUM(IF(f.status=1,1,0)) as density,
// SUM(IF(f.status=1,f.fine_amount,0)) as total_fine,
// SUM(IF(f.status=3,1,0)) as w_offed,
// (SELECT SUM(fy.deposit_amount) FROM fine_payments as fy WHERE fy.is_deleted=0 AND fy.fined_school_id = fs.fined_school_id ) as paid_amount
// FROM fines as f
// INNER JOIN fined_schools fs ON (fs.fined_school_id = f.fined_school_id)
// ";
// $fine_summary = $this->db->query($query)->result()[0];
?>

<table class="table table-bordered table-striped">
    <thead>
        <!-- <tr>
            <td colspan="6" style="text-align: right;"><strong> Fine Summary</strong></td>
            <td><?php //echo $fine_summary->density; 
                ?></td>
            <td><?php //echo $fine_summary->total_fine; 
                ?></td>
            <td><?php //echo $fine_summary->w_offed; 
                ?></td>
            <td><?php //echo $fine_summary->paid_amount; 
                ?></td>
            <td><?php //echo $fine_summary->total_fine - $fine_summary->paid_amount; 
                ?></td>
            <td></td>
        </tr> -->
        <tr>
            <th>#</th>
            <th>School ID</th>
            <th>School Name</th>
            <th>District</th>
            <th>Tehsil</th>
            <th>Address</th>
            <th>Frequency</th>
            <th>Total Fine</th>
            <th>Waived Off</th>
            <th>Total Paid</th>
            <th>Total Remain</th>
            <th></th>
        </tr>
    </thead>
    <tbody>


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
                </td>
            </tr>
        <?php } ?>

    </tbody>
</table>