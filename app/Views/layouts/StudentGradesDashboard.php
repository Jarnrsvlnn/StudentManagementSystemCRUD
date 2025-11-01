<div class="grade-container">
    <div class="buttons-container">
        <button class="add-grades">Add</button>
    </div>
    <div class="table-container">
        <table>
            <tr style="text-align: center;">
                <th colspan="5">All Students' Grades</th>
            </tr>
            <tr style="text-align: center;">
                <th>Student ID</th>
                <th>Full Name</th>
                <th>Average Grade</th>
                <th>Remarks</th>
                <th>View</th>
            </tr>
            
            <?php foreach($avgGrades as $studentGrade): ?>
                <tr style="text-align: center;">
                    <td><?= htmlspecialchars($studentGrade['student_id']) ?></td>
                    <td><?= htmlspecialchars($studentGrade['full_name']) ?></td>
                    <td><?= htmlspecialchars($studentGrade['avg_grade'] ?? '') ?></td>
                    <?php if ($studentGrade['avg_grade'] >= 70): ?>
                        <td style="color: green;"><?= htmlspecialchars($studentGrade['remarks']) ?></td>
                    <?php else: ?>
                        <td style="color: red;"><?= htmlspecialchars($studentGrade['remarks']) ?></td>
                    <?php endif; ?>
                    <td><button onclick="location.href='/grades/quarterly'"><span class="material-symbols-outlined">keyboard_arrow_right</span></button></td>
                </tr>
            <?php endforeach; ?>    
        </table>
    </div>

    <dialog class="grade-dialog">
        <button class="close-dialog">Close</button>
        <form method="post">
            <div>
                <label>Choose Student to Assign</label>
                <select name="student-id" required>
                    <?php foreach($students as $student): ?>
                        <option value="<?= htmlspecialchars($student['student_id']) ?>"><?= htmlspecialchars($student['full_name']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>   
            <div>
                <label>Choose Subject to Assign</label>
                <select name="subject-id" required>
                    <?php foreach($subjects as $subject): ?>
                        <option value="<?= htmlspecialchars($subject['id']) ?>"><?= htmlspecialchars($subject['subject_name']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>   
            <div>
                <label>Choose Quarter to Grade</label>
                <select name="quarter" required>
                    <option value="1st">1st Quarter</option>
                    <option value="2nd">2nd Quarter</option>
                    <option value="3rd">3rd Quarter</option>
                    <option value="4th">4th Quarter</option>
                </select>
            </div>    
            <div>
                <label>Input Grade</label>
                <input type="number" step="any" name="grade" min="60" max="100" required>
            </div>
            <div>
                <button type="submit">Create Student</button>
            </div>
        </form>
    </dialog>
</div>

