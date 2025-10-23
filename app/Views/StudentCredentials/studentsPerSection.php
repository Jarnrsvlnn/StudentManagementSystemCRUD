<?php
use app\Helpers\Format;
?>

<?php foreach($gradeLevels as $gradeLevel => $sections): ?>
    <table class="table table-striped-columns">
        <?php foreach($sections as $section => $students): ?>
            <tr style="text-align: center;">
                <th class="table-dark" colspan="8"><?= htmlspecialchars($section) ?> - <?= htmlspecialchars(Format::formatToRomanNumeral($gradeLevel)) ?></th>
            </tr>
            <tr style="text-align: center;">
                <th class="table-dark">Student ID</th>
                <th class="table-dark">Full Name</th>
                <th class="table-dark">Email</th>
                <th class="table-dark">Gender</th>
                <th class="table-dark">Address</th>
                <th colspan="4" class="table-dark">Status</th>
            </tr>

            <?php foreach($students as $student): ?>
                <tr style="text-align: center;">
                    <td><?= htmlspecialchars($student['student_id']) ?></td>
                    <td><?= htmlspecialchars($student['full_name']) ?></td>
                    <td><?= htmlspecialchars($student['email']) ?></td>
                    <td><?= htmlspecialchars($student['gender']) ?></td>
                    <td><?= htmlspecialchars($student['address']) ?></td>
                    <td colspan="4"><?= htmlspecialchars($student['status']) ?></td>
                </tr>
            <?php endforeach; ?>

            <tr style="text-align: center;">
                <th class="table-dark" colspan="7">Total Students</th>
                <td class="table-dark"><?= htmlspecialchars($totalStudent)?></td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php endforeach; ?>
