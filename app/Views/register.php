<form class="row g-3" method="post">
  <div class="col-md-6">
    <label class="form-label">Student ID</label>
    <input type="text" class="form-control" name="student-id" placeholder="2025XXXX" minlength="8" maxlength="8" pattern="2025\d{4}" inputmode="numeric" required>
  </div>
  <div class="col-md-6">
    <label class="form-label">Full Name</label>
    <input type="text" class="form-control" name="full-name" required>
  </div>
  <div class="col-12">
    <label class="form-label">Address</label>
    <input type="text" class="form-control" name="address" placeholder="1234 Main St" required>
  </div>
  <div class="col-md-6">
    <label class="form-label">Email</label>
    <input type="email" class="form-control" name="email" placeholder="john.doe@example.com" required>
  </div>
  <div class="col-md-6">
    <label class="form-label">Section</label>
    <select class="form-select" name="section-id" required>
      <option selected>Select Section...</option>
      <option value="1">Section 1</option>
      <option value="2">Section 2</option>
    </select>
  </div>
  <div class="col-md-6">
    <label class="form-label">Gender</label>
    <select class="form-select" name="gender" required>
      <option selected>Select Gender...</option>
      <option>Male</option>
      <option>Female</option>
      <option>Other</option>
    </select>
  </div>
  <div class="col-md-6">
    <label class="form-label">Grade Level</label>
    <select class="form-select" name="grade-level-id" required>
      <option selected>Select...</option>
      <?php foreach($gradeLevels as $gradeLevel): ?>
        <option value="<?= htmlspecialchars($gradeLevel['id']) ?>">Grade <?= htmlspecialchars($gradeLevel['grade_num']) ?></option>
      <?php endforeach; ?>
    </select>
  </div>
  <div class="col-12">
    <button type="submit" class="btn btn-primary">Create Student</button>
  </div>
</form>