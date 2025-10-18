<form class="row g-3" method="post">
  <div class="col-12">
    <label class="form-label">Choose Student to Update</label>
    <select class="form-select" name="student-id" required>
        <?php foreach($students as $student): ?>
            <option value="<?= htmlspecialchars($student['student_id']) ?>"><?= htmlspecialchars($student['full_name']) ?></option>
        <?php endforeach; ?>
    </select>
  </div>    
  <h1>Input new values</h1>
  <div class="col-md-6">
    <label class="form-label">Full Name</label>
    <input type="text" class="form-control" name="full-name" required>
  </div>
  <div class="col-md-6">
    <label class="form-label">Email</label>
    <input type="email" class="form-control" name="email" placeholder="john.doe@example.com" required>
  </div>
  <div class="col-12">
    <label class="form-label">Section</label>
    <select class="form-select" name="section" required>
      <option selected>Select Section...</option>
      <option value="1">Section 1</option>
      <option value="2">Section 2</option>
    </select>
  </div>
  <div class="col-12">
    <label class="form-label">Address</label>
    <input type="text" class="form-control" name="address" placeholder="1234 Main St" required>
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
    <select class="form-select" name="grade-level" required>
      <option selected>Select...</option>
      <option value="7">Grade 7</option>
      <option value="8">Grade 8</option>
      <option value="9">Grade 9</option>
      <option value="10">Grade 10</option>
    </select>
  </div>
  <div class="col-12">  
    <button type="submit" class="btn btn-primary">Update Student</button>
  </div>
</form>