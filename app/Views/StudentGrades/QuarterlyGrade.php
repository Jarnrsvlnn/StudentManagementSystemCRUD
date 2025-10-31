
<div class="student-grade-container">
    <div class="table-container">
        <table>
            <tr>
                <th colspan="7">Name: (Insert name from an array here) </th>
            </tr>
            <tr>
                <th colspan="2">Subject</th>
                <th colspan="2">Q1</th>
                <th colspan="2">Q2</th>
                <th colspan="2">Q3</th>
                <th colspan="2">Q4</th>
                <th colspan="2">Final</th>
                <th colspan="2">Remarks</th>
            </tr>
            <?php foreach($studentGrades as $studentGrade): ?>
                <tr>
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
    </div>
</div>


