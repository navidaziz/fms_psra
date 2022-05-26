<h4><?php echo $title ?></h4>
<table class="table table-bordered table_small">
  <tr>
    <th>#</th>

    <th>School ID</th>
    <th>School Name</th>
    <th></th>
    <th>Session</th>
    <th>Action</th>
  </tr>
  <?php
  $count = 1;
  $previous_school_id = 0;
  foreach ($requests as $request) {
    if ($request->previous_session_status != 8) {
  ?>
      <tr>
        <?php if ($previous_school_id != $request->schools_id) { ?>
          <td><?php echo $count++; ?></td>

          <td><?php echo $request->schools_id ?></td>
          <td><?php echo $request->schoolName ?></td>
        <?php } else { ?>
          <td colspan="3"></td>
        <?php } ?>
        <td><?php
            $words = explode(" ", $request->regTypeTitle);
            $acronym = "";

            foreach ($words as $w) {
              echo strtoupper($w[0]);
            }
            ?></td>
        <td><?php echo $request->sessionYearTitle ?></td>

        <td>
          <button class="btn btn-link btn-sm" onclick="view_request_detail('<?php echo $request->school_id; ?>', '<?php echo $request->sessionYearId; ?>')">View Detail</button>
        </td>

      </tr>
  <?php
      $previous_school_id =  $request->schools_id;
    }
  } ?>

</table>