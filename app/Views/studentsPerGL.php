<?php foreach($gradeLevels as $gradeLevel => $sections): ?>
    <table class="table table-striped-columns">
        <tr style="text-align: center;">
            <th class="table-dark" colspan="8"><?= htmlspecialchars($gradeLevel) ?></th>
        </tr>
        <tr style="text-align: center;">
            <th class="table-dark">Student ID</th>
            <th class="table-dark">Full Name</th>
            <th class="table-dark">Email</th>
            <th class="table-dark">Gender</th>
            <th class="table-dark">Address</th>
            <th class="table-dark">Section</th>
            <th colspan="2" class="table-dark">Status</th>
        </tr>

        <?php foreach($sections as $section => $students): ?>
            <?php foreach($students as $student): ?>
                <tr style="text-align: center;">
                    <td><?= htmlspecialchars($student['student_id']) ?></td>
                    <td><?= htmlspecialchars($student['full_name']) ?></td>
                    <td><?= htmlspecialchars($student['email']) ?></td>
                    <td><?= htmlspecialchars($student['gender']) ?></td>
                    <td><?= htmlspecialchars($student['address']) ?></td>
                    <td><?= htmlspecialchars($student['section_name']) ?></td>
                    <td colspan="2"><?= htmlspecialchars($student['status']) ?></td>
                </tr>
            <?php endforeach; ?>
        <?php endforeach; ?>

        <tr style="text-align: center;">
            <th class="table-dark" colspan="7">Total Students</th>
            <td class="table-dark"><?= htmlspecialchars($totalStudent)?></td>
        </tr>
    </table>
<?php endforeach; ?>
