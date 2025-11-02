
<div class="student-grade-container">
    <div class="table-container">
        <table>
            <tr>
                <th colspan="13">Name: <?= htmlspecialchars($quarterGrades[0]['full_name']) ?></th>
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
            <?php foreach($quarterGrades as $studentGrade): ?>
                <tr>
                    <td colspan="2"><?= htmlspecialchars($studentGrade['subject_name']) ?></td>
                    <td colspan="2"><?= htmlspecialchars($studentGrade['q1'] ?? '') ?></td>
                    <td colspan="2"><?= htmlspecialchars($studentGrade['q2'] ?? '') ?></td>
                    <td colspan="2"><?= htmlspecialchars($studentGrade['q3'] ?? '') ?></td>
                    <td colspan="2"><?= htmlspecialchars($studentGrade['q4'] ?? '') ?></td>
                    <td colspan="2"><?= htmlspecialchars($studentGrade['final_grade']) ?></td>
                    <?php if ($studentGrade['final_grade'] >= 70): ?>
                        <td colspan="2" style="color: green;"><?= htmlspecialchars($studentGrade['remarks']) ?></td>
                    <?php else: ?>
                        <td colspan="2" style="color: red;"><?= htmlspecialchars($studentGrade['remarks']) ?></td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>

                        
