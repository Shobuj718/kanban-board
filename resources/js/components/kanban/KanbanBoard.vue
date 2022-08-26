<template>
	<div>
	    <div class="container">
        <div class="kanban-heading">
            <strong class="kanban-heading-text">Kanban Board</strong>
        </div>

        <form @submit.prevent="addTask">
	        <div class="kanban-heading">
	        	
            	<input v-model.trim="newTask.title" type="text" class="form-control">
	            <span v-show="errorMessage" class="text-red">
			          {{ errorMessage }}
			        </span>
	            <button type="submit">Add</button>
        		
	        </div>
	    </form>

        <br/>
        <div class="kanban-board">
            <div class="kanban-block" id="todo">
			    <strong>To Do</strong>
			    
			    <div class="task" id="task1" >
			        <span>new task</span>
			    </div>
			    <div class="task" id="task1" >
			        <span>Another new task</span>
			    </div>
			    <div class="task" id="task1" >
			        <span>Another new task</span>
			    </div>
			</div>

            <div class="kanban-block" id="inprogress">
                <strong>In Progress</strong>
                <div class="task" id="task2">
			        <span>Task 3</span>
			    </div>
			    <div class="task" id="task2">
			        <span>Task 4</span>
			    </div>
            </div>
            <div class="kanban-block" id="done">
                <strong>Done</strong>
                <div class="task" id="task2">
			        <span>Task 1</span>
			    </div>
			    <div class="task" id="task2">
			        <span>Task 2</span>
			    </div>
			    <div class="task" id="task2">
			        <span>Task 2</span>
			    </div>
			    <div class="task" id="task2">
			        <span>Task 2</span>
			    </div>
			    <div class="task" id="task2">
			        <span>Task 2</span>
			    </div>
            </div>
        </div>
    </div>
	</div>
</template>

<script>
export default{
	props: {
    statusId: Number
  },
	data() {
		return {
			tasks: [],
			 statuses: [],

			 newTask: {
		        title: "",
		      },
		      errorMessage: ""

		}
	},

	mounted() {
		this.getTasks();
		this.toDoTaskList();
	  },

	methods: {
		getTasks(){
			// axios.get('/tasks')
			// 	.then((res) => {
			// 		this.statuses = res.data.data;
			// 		console.log('statuses data');
			// 		console.log(res);
			// 	})
		},
		toDoTaskList(){
			// axios.get('/to-do-tasks')
			// 	.then((res) => {
			// 		this.tasks = res.data;
			// 		console.log('to-do-tasks data');
			// 		console.log(this.tasks);
			// 	})
		},
		moveTasktoProgress(id){
			this.axios.post(`/task-move/to/progress/${id}`)
				.then((res) => {
					this.tasks = res.data;
					console.log('to-doddd-tasks data');
					console.log(this.tasks);
				})
		},

		addTask() {
	      // Basic validation so we don't send an empty task to the server
	      if (!this.newTask.title) {
	        this.errorMessage = "The title field is required";
	        return;
	      }

	      axios
	        .post("/tasks", this.newTask)
	        .then((res) => {
	          console.log(res);
	          this.toDoTaskList();
	        })
	        .catch((err) => {
	          console.log(err)
	        });
	    },


	}
}
</script>

<style scoped>

	body {
	  background-color: black;
	}
	.container {
	  width: 70%;
	  min-width: 50%;
	  margin: auto;
	  display: flex;
	  flex-direction: column;
	}

	.kanban-heading {
	  display: flex;
	  flex-direction: row;
	  justify-content: center;
	  font-family: sans-serif;
	}

	.kanban-heading-text {
	  font-size: 1.8rem;
	  background-color: tomato;
	  padding: 0.8rem 1.7rem;
	  border-radius: 0.5rem;
	  margin: 1rem;
	  color: white;
	}

	.kanban-board {
	  display: flex;
	  flex-direction: row;
	  justify-content: space-between;
	  font-family: sans-serif;
	}

	.kanban-block {
	  padding: 0.6rem;
	  width: 30.5%;
	  min-width: 14rem;
	  min-height: 4.5rem;
	  border-radius: 0.3rem;
	}

	#todo {
	  background-color: ;
	}

	#inprogress {
	  background-color: ;
	}

	#done {
	  background-color: ;
	}

	.task {
  background-color: white;
  margin: 0.2rem 0rem 0.3rem 0rem;
  border: 0.1rem solid black;
  border-radius: 0.2rem;
  padding: 0.5rem 0.2rem 0.5rem 2rem;
}

#task-button {
  margin: 0.2rem 0rem 0.1rem 0rem;
  background-color: white;
  border-radius: 0.2rem;
  width: 100%;
  border: 0.25rem solid black;
  padding: 0.5rem 2.7rem;
  border-radius: 0.3rem;
  font-size: 1rem;
}


</style>