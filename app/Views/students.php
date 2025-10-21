<form class="row g-3" method="post">
    <div class="col-2">
    <label class="form-label">View All</label>
    <select class="form-select" name="category" required>
        <option selected>All Students</option>
        <option value="1">Grade Level</option>
        <option value="2">Section</option>
    </select>
    <div class="col-12">  
        <button type="submit" class="btn btn-primary">Update Student</button>
    </div>
    </div>
</form>

<h1>All Students</h1>

<table class="table table-striped-columns">
    <tr>
        <th class="table-dark">Student ID</th>
        <th class="table-dark">Full Name</th>
        <th class="table-dark">Email</th>
        <th class="table-dark">Gender</th>
        <th class="table-dark">Address</th>
        <th class="table-dark">Section</th>
        <th class="table-dark">Grade Level</th>
        <th class="table-dark">Status</th>
    </tr>

    <?php foreach($students as $student): ?>
        <tr>
            <td><?= htmlspecialchars($student['student_id']) ?></td>
            <td><?= htmlspecialchars($student['full_name']) ?></td>
            <td><?= htmlspecialchars($student['email']) ?></td>
            <td><?= htmlspecialchars($student['gender']) ?></td>
            <td><?= htmlspecialchars($student['address']) ?></td>
            <td><?= htmlspecialchars($student['section_name']) ?></td>
            <td>Grade <?= htmlspecialchars($student['grade_num']) ?></td>
            <td><?= htmlspecialchars($student['status']) ?></td>
        </tr>
    <?php endforeach; ?>
    <tr>
        <th class="table-dark">Total Number of Students</th>
        <td class="table-dark"><?= htmlspecialchars($totalStudent)?></td>
    </tr>
</table>
<ul>

</ul>