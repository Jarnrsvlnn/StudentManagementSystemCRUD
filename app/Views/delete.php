<form class="row g-3" method="post">
  <div class="col-12">
    <label class="form-label">Choose Student</label>
    <select class="form-select" name="student-id" required>
        <?php foreach($students as $student): ?>
            <option value="<?= htmlspecialchars($student['student_id']) ?>"><?= htmlspecialchars($student['full_name']) ?></option>
        <?php endforeach; ?>
    </select>
  </div>
  <div class="col-12">  
    <button type="submit" class="btn btn-primary">Delete Student</button>
  </div>
</form>