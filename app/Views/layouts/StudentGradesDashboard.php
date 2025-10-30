<div class="grade-container">
    <div class="buttons-container">
        <button class="edit-grades">Edit</button>
        <button class="add-grades">Add</button>
    </div>
    <div class="table-container">
        <table>
            <tr style="text-align: center;">
                <th colspan="9">All Students' Grades</th>
            </tr>
            <tr style="text-align: center;">
                <th rowspan="2">Student ID</th>
                <th rowspan="2">Full Name</th>
                <th rowspan="2">Subject</th>
                <th colspan="4">Quarter</th>
                <th rowspan="2">Final Grade</th>
                <th rowspan="2">Remarks</th>
            </tr>
            <tr style="text-align: center;">
                <th colspan="1">1st</th>
                <th colspan="1">2nd</th>
                <th colspan="1">3rd</th>
                <th colspan="1">4th</th>
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


<div class="student-grade-container">
    <div class="table-container">
        <table>
        </table>
    </div>
</div>


