<form class="row g-3" method="post">
    <div class="col-2">
        <label class="form-label">View All</label>
        <select class="form-select" name="category" required>
            <option value="all-students" selected>All Students</option>
            <option value="by-grade-level">Grade Level</option>
            <option value="by-section">Section</option>
        </select>
        <div class="col-12">  
            <button type="submit" class="btn btn-primary">Update Student</button>
        </div>
    </div>
</form>

<div class="container">
    {{content}}
</div>
