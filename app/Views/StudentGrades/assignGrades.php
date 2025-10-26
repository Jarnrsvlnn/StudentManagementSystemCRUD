<form class="row g-3" method="post">
  <div class="col-12">
    <label class="form-label">Choose Student to Assign</label>
    <select class="form-select" name="student-id" required>
        <?php foreach($students as $student): ?>
            <option value="<?= htmlspecialchars($student['student_id']) ?>"><?= htmlspecialchars($student['full_name']) ?></option>
        <?php endforeach; ?>
    </select>
  </div>   
  <div class="col-md-6">
    <label class="form-label">Choose Subject to Assign</label>
    <select class="form-select" name="subject-id" required>
        <?php foreach($subjects as $subject): ?>
            <option value="<?= htmlspecialchars($subject['id']) ?>"><?= htmlspecialchars($subject['subject_name']) ?></option>
        <?php endforeach; ?>
    </select>
  </div>   
  <div class="col-md-6">
    <label class="form-label">Choose Quarter to Grade</label>
    <select class="form-select" name="quarter" required>
        <option value="1st">1st Quarter</option>
        <option value="2nd">2nd Quarter</option>
        <option value="3rd">3rd Quarter</option>
        <option value="4th">4th Quarter</option>
    </select>
  </div>    
  <div class="col-md-6">
    <label class="form-label">Input Grade</label>
    <input type="number" step="any" class="form-control" name="grade" min="60" max="100" required>
  </div>
  <div class="col-12">
    <button type="submit" class="btn btn-primary">Create Student</button>
  </div>
</form>
