<table class="table table-striped-columns">
    <tr style="text-align: center;">
        <th class="table-dark" colspan="8">All Students' Grades</th>
    </tr>
    <tr style="text-align: center;">
        <th class="table-dark">Student ID</th>
        <th class="table-dark">Full Name</th>
        <th class="table-dark">Subject</th>
        <th class="table-dark">Grade</th>
        <th class="table-dark">Remarks</th>
    </tr>

    <?php foreach($grades as $studentGrade): ?>
        <tr style="text-align: center;">
            <td><?= htmlspecialchars($studentGrade['student_id']) ?></td>
            <td><?= htmlspecialchars($studentGrade['full_name']) ?></td>
            <td><?= htmlspecialchars($studentGrade['subject_code']) ?></td>
            <td><?= htmlspecialchars($studentGrade['grade']) ?></td>
            <?php if ($studentGrade['grade'] >= 70): ?>
            <td style="color: green;"><?= htmlspecialchars($studentGrade['remarks']) ?></td>
            <?php else: ?>
            <td style="color: red;"><?= htmlspecialchars($studentGrade['remarks']) ?></td>
            <?php endif; ?>
        </tr>
    <?php endforeach; ?>
</table>