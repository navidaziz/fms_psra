<?php
$query = "SELECT fs.fined_school_id, fs.school_id, fs.school_name, fs.district_name, fs.tehsil_name, fs.address ,
							SUM(IF(f.status=1,1,0)) as density,
							SUM(IF(f.status=1,f.fine_amount,0)) as total_fine,
							SUM(IF(f.status=3,1,0)) as w_offed,
							(SELECT SUM(fy.deposit_amount) FROM fine_payments as fy WHERE fy.is_deleted=0 AND fy.fined_school_id = fs.fined_school_id ) as paid_amount
							FROM fines as f
							INNER JOIN fined_schools fs ON (fs.fined_school_id = f.fined_school_id)
							";
$fine_summary = $this->db->query($query)->result()[0];
?>

<style>
    .table2 tr td {
        text-align: center;
    }
</style>
<small>
    <table class="table table-bordered table-striped table2">
        <thead>
            <tr>

                <th rowspan="2">Fine Summary</th>
                <th>Frequency</th>
                <th>Total Fine</th>
                <th>Waived Off</th>
                <th>Total Paid</th>
                <th>Total Remain</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th style="text-align: right;"><strong> Total</strong></th>
                <td><?php echo $fine_summary->density; ?></td>
                <td><?php echo $fine_summary->total_fine; ?></td>
                <td><?php echo $fine_summary->w_offed; ?></td>
                <td><?php echo $fine_summary->paid_amount; ?></td>
                <td><?php echo $fine_summary->total_fine - $fine_summary->paid_amount; ?></td>

            </tr>
        </tbody>
    </table>
</small>