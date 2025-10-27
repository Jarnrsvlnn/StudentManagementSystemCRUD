<table class="table table-striped-columns">
    <tr style="text-align: center;">
        <th class="table-dark" colspan="9">All Students' Grades</th>
    </tr>
    <tr style="text-align: center;">
        <th class="table-dark" rowspan="2">Student ID</th>
        <th class="table-dark" rowspan="2">Full Name</th>
        <th class="table-dark" rowspan="2">Subject</th>
        <th class="table-dark" colspan="4">Quarter</th>
        <th class="table-dark" rowspan="2">Final Grade</th>
        <th class="table-dark" rowspan="2">Remarks</th>
    </tr>
    <tr style="text-align: center;">
        <th class="table-dark" colspan="1">1st</th>
        <th class="table-dark" colspan="1">2nd</th>
        <th class="table-dark" colspan="1">3rd</th>
        <th class="table-dark" colspan="1">4th</th>
    </tr>
    
    <?php foreach($grades as $studentGrade): ?>
        <tr style="text-align: center;">
            <td><?= htmlspecialchars($studentGrade['student_id']) ?></td>
            <td><?= htmlspecialchars($studentGrade['full_name']) ?></td>
            <td><?= htmlspecialchars($studentGrade['subject_code']) ?></td>
            <td><?= htmlspecialchars($studentGrade['q1'] ?? '') ?></td>
            <td><?= htmlspecialchars($studentGrade['q2'] ?? '') ?></td>
            <td><?= htmlspecialchars($studentGrade['q3'] ?? '') ?></td>
            <td><?= htmlspecialchars($studentGrade['q4'] ?? '') ?></td>
            <td><?= htmlspecialchars($studentGrade['final_grade']) ?></td>
            <?php if ($studentGrade['final_grade'] >= 70): ?>
            <td style="color: green;"><?= htmlspecialchars($studentGrade['remarks']) ?></td>
            <?php else: ?>
            <td style="color: red;"><?= htmlspecialchars($studentGrade['remarks']) ?></td>
            <?php endif; ?>
        </tr>
    <?php endforeach; ?>
</table>
