
<div class="student-grade-container">
    <div class="table-container">
        <table>
            <tr>
                <th colspan="15">Name: <?= htmlspecialchars($quarterGrades[0]['full_name']) ?></th>
            </tr>
            <tr>
                <th colspan="2">Subject</th>
                <th colspan="2">Q1</th>
                <th colspan="2">Q2</th>
                <th colspan="2">Q3</th>
                <th colspan="2">Q4</th>
                <th colspan="2">Final</th>
                <th colspan="2">Remarks</th>
                <th colspan="2">Edit</th>
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
                        <td colspan="2" style="color: green;" ><?= htmlspecialchars($studentGrade['remarks']) ?></td>
                    <?php else: ?>
                        <td colspan="2" style="color: red;"><?= htmlspecialchars($studentGrade['remarks']) ?></td>
                    <?php endif; ?>
                    <td colspan="2"><button class="edit-grade"><span class="material-symbols-outlined">edit</span></button></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>

    <dialog class="edit-grade-dialog">
        <button class="close-dialog">Close</button>
        <form action="post">
            <table>
                <tr>
                    <th colspan="2">Subject</th>
                    <th colspan="2">Q1</th>
                    <th colspan="2">Q2</th>
                    <th colspan="2">Q3</th>
                    <th colspan="2">Q4</th>
                </tr>
                <tr>
                    <td colspan="2">
                        <?= htmlspecialchars($studentGrades['subject-name'] ?? '') ?>
                    </td>
                    <td colspan="2">    
                        <input name="q1" type="number">
                    </td>
                    <td colspan="2">
                        <input name="q2" type="number">
                    </td>
                    <td colspan="2">
                        <input name="q3" type="number">
                    </td>
                    <td colspan="2">
                        <input name="q4" type="number">
                    </td>
                </tr>
            </table>
            <button type="submit" class="update-dialog">Update</button>
        </form>
    </dialog>
</div>

                        
