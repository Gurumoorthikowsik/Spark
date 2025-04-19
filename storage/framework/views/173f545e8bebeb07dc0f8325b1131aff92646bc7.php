<?php echo $__env->make('common.employee.inner_header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('common.employee.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<style>
.task-board {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 20px;
  padding: 20px;
}

.column {
  background-color: #f4f4f4;
  color: #333;
  border-radius: 8px;
  box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
  display: flex;
  flex-direction: column;
  overflow: hidden;
}

.column-header {
  background-color: #333;
  color: #fff;
  padding: 10px 15px;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.column-header h3 {
  margin: 0;
  font-size: 16px;
  text-transform: uppercase;
}

.column-header .task-count {
  font-size: 12px;
  background-color: #555;
  padding: 3px 8px;
  border-radius: 5px;
}

.card-container {
  padding: 0px;
  flex-grow: 1;
  min-height: 100px;
}

.card {
  background-color: #fff;
  color: #333;
  margin-bottom: 10px;
  padding: 15px;
  border-radius: 8px;
  box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
  cursor: grab;
}

.card h4 {
  margin: 0 0 5px;
  font-size: 14px;
  font-weight: bold;
}

.card p {
  margin: 0 0 10px;
  font-size: 12px;
  color: #666;
}

.tags {
  display: flex;
  gap: 5px;
  flex-wrap: wrap;
}

.tag {
  font-size: 11px;
  padding: 2px 6px;
  border-radius: 5px;
  text-transform: uppercase;
  color: #fff;
}

.tag.blue {
  background-color: #17a2b8;
}

.tag.orange {
  background-color: #ffa500;
}

.tag.green {
  background-color: #28a745;
}

.tag.done {
  background-color: #6c757d;
}

.hidden {
  display: none;
}


/* Styling for columns and container wrapper */
.task-board {
    display: flex;
    justify-content: space-between;
    overflow-x: auto;
}

.column {
    width: 23%;
    background-color: #f4f4f4;
    border-radius: 5px;
    padding: 10px;
    margin: 10px;
    position: relative;
}

.column-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: #3b3f45;
    padding: 10px;
    border-radius: 5px;
}

.card-container-wrapper {
    height: 400px;  /* Adjust the height to your needs */
    overflow-y: auto; /* Enables vertical scrolling */
    overflow-x: hidden; /* Disables horizontal scrolling */
    padding-right: 10px; /* Adds some space to the right for the scrollbar */
}

.card-container {
    display: flex;
    flex-direction: column;
    gap: 10px;
    padding: 10px;
}

.card {
    background-color: #fff;
    padding: 10px;
    border-radius: 5px;
    box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease;
}

.card img {
    width: 100%;
    height: auto;
    border-radius: 5px;
}

.card h4 {
    margin: 10px 0;
}

.card .tags {
    display: flex;
    gap: 5px;
}

.card .tag {
    padding: 5px;
    border-radius: 3px;
    color: #fff;
    font-size: 12px;
}

.tag.blue {
    background-color: #007bff;
}

.tag.orange {
    background-color: #ff8c00;
}

</style>

<div class="content-body">

    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo e(URL::to('/employees/dashboard')); ?>">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Task</a></li>
            </ol>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-12">


              <div class="task-board">
                <!-- TO DO Column -->
                <div class="column" data-status="0" id="to-do-column">
                    <div class="column-header">
                        <h3 class="text-white">TO DO</h3>
                        <span class="task-count" id="to-do-count"><?php echo e($bugs->where('Status', 0)->count()); ?> Task</span>
                    </div>
                    <div class="card-container-wrapper">
                    <div class="card-container" id="to-do-container">
                        <?php $__currentLoopData = $bugs->where('Status', 0); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bug): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="card" id="card-<?php echo e($bug->id); ?>" draggable="true" data-id="<?php echo e($bug->id); ?>" data-status="0">
                                <img src="<?php echo e($bug->image); ?>" alt="">
                                <h4><?php echo e($bug->bugs_name); ?></h4>
                                <p><?php echo e($bug->bugs_desc); ?></p>
                                <div class="tags">
                                    <span class="tag blue"><?php echo e($bug->module_name); ?></span>
                                    <span class="tag orange">TO DO</span>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
                </div>
            
                <!-- IN PROGRESS Column -->
                <div class="column" data-status="1" id="in-progress-column">
                    <div class="column-header">
                        <h3 class="text-white">IN PROGRESS</h3>
                        <span class="task-count" id="in-progress-count"><?php echo e($bugs->where('Status', 1)->count()); ?> Task</span>
                    </div>
                    <div class="card-container" id="in-progress-container">
                        <?php $__currentLoopData = $bugs->where('Status', 1); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bug): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="card" id="card-<?php echo e($bug->id); ?>" draggable="true" data-id="<?php echo e($bug->id); ?>" data-status="1">
                                <img src="<?php echo e($bug->image); ?>" alt="">
                                <h4><?php echo e($bug->bugs_name); ?></h4>
                                <p><?php echo e($bug->bugs_desc); ?></p>
                                <div class="tags">
                                    <span class="tag blue"><?php echo e($bug->module_name); ?></span>
                                    <span class="tag orange">IN PROGRESS</span>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            
                <!-- DEVELOPMENT DONE Column -->
                <div class="column" data-status="2" id="development-done-column">
                    <div class="column-header">
                        <h3 class="text-white">DEVELOPMENT DONE</h3>
                        <span class="task-count" id="development-done-count"><?php echo e($bugs->where('Status', 2)->count()); ?> Task</span>
                    </div>
                    <div class="card-container" id="development-done-container">
                        <?php $__currentLoopData = $bugs->where('Status', 2); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bug): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="card" id="card-<?php echo e($bug->id); ?>" draggable="true" data-id="<?php echo e($bug->id); ?>" data-status="2">
                                <img src="<?php echo e($bug->image); ?>" alt="">
                                <h4><?php echo e($bug->bugs_name); ?></h4>
                                <p><?php echo e($bug->bugs_desc); ?></p>
                                <div class="tags">
                                    <span class="tag blue"><?php echo e($bug->module_name); ?></span>
                                    <span class="tag orange">DEVELOPMENT DONE</span>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            
                <!-- TASK COMPLETED Column -->
                <div class="column" data-status="3" id="task-completed-column">
                    <div class="column-header">
                        <h3 class="text-white">TASK COMPLETED</h3>
                        <span class="task-count" id="task-completed-count"><?php echo e($bugs->where('Status', 3)->count()); ?> Task</span>
                    </div>
                    <div class="card-container" id="task-completed-container">
                        <?php $__currentLoopData = $bugs->where('Status', 3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bug): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="card" id="card-<?php echo e($bug->id); ?>" draggable="true" data-id="<?php echo e($bug->id); ?>" data-status="3">
                                <img src="<?php echo e($bug->image); ?>" alt="">
                                <h4><?php echo e($bug->bugs_name); ?></h4>
                                <p><?php echo e($bug->bugs_desc); ?></p>
                                <div class="tags">
                                    <span class="tag blue"><?php echo e($bug->module_name); ?></span>
                                    <span class="tag orange">TASK COMPLETED</span>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
            



            
            </div>






        </div>
    </div>
</div>
</div>
</div>

</div>

<script>


// Select all columns and cards
const columns = document.querySelectorAll('.column');
const cards = document.querySelectorAll('.card');

// Add drag-and-drop events to cards
cards.forEach((card) => {
  card.addEventListener('dragstart', handleDragStart);
  card.addEventListener('dragend', handleDragEnd);
});

// Add drag-and-drop events to columns
columns.forEach((column) => {
  column.addEventListener('dragover', handleDragOver);
  column.addEventListener('drop', handleDrop);
});

// Handle the start of dragging
function handleDragStart(event) {
  event.dataTransfer.setData('text/plain', event.target.id); // Store card ID
  setTimeout(() => {
    event.target.classList.add('hidden'); // Hide the card temporarily
  }, 0);
}

// Handle the end of dragging
function handleDragEnd(event) {
  event.target.classList.remove('hidden'); // Show the card again
}

// Allow dropping
function handleDragOver(event) {
  event.preventDefault(); // Allow drop
}

// Handle dropping
function handleDrop(event) {
  event.preventDefault();

  const cardId = event.dataTransfer.getData('text'); // Get card ID
  const draggedCard = document.getElementById(cardId);

  if (draggedCard) {
    // Append the card to the column it was dropped into
    const cardContainer = this.querySelector('.card-container');
    cardContainer.appendChild(draggedCard);

    // Update the task count for all columns
    updateTaskCounts();
  }
}

// Update task counts
function updateTaskCounts() {
  columns.forEach((column) => {
    const count = column.querySelectorAll('.card').length;
    column.querySelector('.task-count').textContent = `${count} Task${count !== 1 ? 's' : ''}`;
  });
}

// Initialize the task counts on page load
updateTaskCounts();


</script>


  <script>
    document.addEventListener('DOMContentLoaded', () => {
    const columns = document.querySelectorAll('.column');

    columns.forEach(column => {
        column.addEventListener('dragover', (e) => {
            e.preventDefault();
        });

        column.addEventListener('drop', (e) => {
            const cardId = e.dataTransfer.getData('text');
            const card = document.getElementById(cardId);
            const newStatus = column.dataset.status;

            // Append the card to the new column
            column.querySelector('.card-container').appendChild(card);

            // Send an AJAX request to update the status in the database
            fetch('updateStatusboard', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
                body: JSON.stringify({
                    id: card.dataset.id,
                    status: newStatus,
                }),
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        console.log(data.message);
                    } else {
                        console.error('Failed to update status');
                    }
                })
                .catch(err => console.error(err));
        });
    });

    // Add draggable event listeners to cards
    const cards = document.querySelectorAll('.card');
    cards.forEach(card => {
        card.addEventListener('dragstart', (e) => {
            e.dataTransfer.setData('text', card.id);
        });
    });
});

  </script>
  
<script>
      function updateTaskCounts() {
      const columns = document.querySelectorAll('.column');
      columns.forEach(column => {
          const count = column.querySelectorAll('.card').length;
          column.querySelector('.task-count').textContent = `${count} Task${count !== 1 ? 's' : ''}`;
      });
  }

  document.addEventListener('drop', updateTaskCounts);

</script>


<?php echo $__env->make('common.employee.inner_footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH C:\xampp\htdocs\dashboard\code\GIT\Spark\resources\views/employee/task-board.blade.php ENDPATH**/ ?>