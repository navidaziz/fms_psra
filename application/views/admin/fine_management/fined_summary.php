<?php
$query = "SELECT 
SUM(`original_fine_amount`) as `original_fine_amount`,
sum(`total_fine`) as `total_fine`, 
          sum(`total_waived_off`) as `total_waived_off`, 
          sum(`total_fine_paid`) as `total_fine_paid`, 
          sum(`total_fine_remaining`) as `total_fine_remaining` FROM `fine_school_list`;";
$fine_summary = $this->db->query($query)->result()[0];


?>

<style>
    .table2 tr td {
        text-align: center;
    }
</style>
<small>
    <table class="table table-bordered table-striped" style="text-align: center;">
        <thead>
            <tr>
                <th>Total Fine</th>

                <th>Total Waived Off</th>
                <!-- <th>Total Fine Payable</th> -->
                <th>Total Fine Paid</th>
                <th>Total Fine Remaining</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?php echo @number_format($fine_summary->original_fine_amount, 2); ?></td>
                <td><?php echo @number_format($fine_summary->total_waived_off, 2); ?></td>
                <!-- <td><?php echo @number_format($fine_summary->total_fine, 2); ?></td> -->

                <td><?php echo @number_format($fine_summary->total_fine_paid, 2); ?></td>
                <td><?php echo @number_format($fine_summary->total_fine - $fine_summary->total_fine_paid, 2); ?></td>
            </tr>
        </tbody>
    </table>
</small>