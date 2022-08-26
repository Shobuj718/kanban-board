<template>
	<div>
	    <div class="container">
        <div class="kanban-heading">
            <strong class="kanban-heading-text">Kanban Board</strong>
        </div>

        <form @submit.prevent="addTask">
	        <div class="kanban-heading">
	        	
            	<input v-model.trim="newTask.title" type="text" placeholder="Enter task title" class="form-control">
	            	
			        <span v-if="errors.title" style="color: red" class="">
                        {{ errors.title[0] }}
                    </span>
	            <button type="submit">Add</button>
        		
	        </div>
	    </form>

        <br/>
        <div class="kanban-board">
            <div class="kanban-block" id="todo">
			    <strong>To Do</strong>
			    
			    <div class="task" id="task1" v-for="(task, index) in tasks" :key="index.id">
			        <span>{{ task.title }}</span>
			        <i @click="moveTasktoProgress(task.id)" style="cursor: pointer;" class="fas fa fa-arrow-right"></i>
			    </div>

			</div>

            <div class="kanban-block" id="inprogress">
                <strong>In Progress</strong>
               
                <div class="task" id="task1" v-for="(task, index) in progress" :key="index.id">
			        <span>{{ task.title }}</span>
			        <i @click="moveTasktoDone(task.id)" style="cursor: pointer;" class="fas fa fa-arrow-right"></i>
			    </div>

            </div>
            <div class="kanban-block" id="done">
                <strong>Done</strong>
                
                <div class="task" id="task1" v-for="(task, index) in complete" :key="index.id">
			        <span>{{ task.title }}</span>
			        <i @click="deleteTask(task.id)" style="cursor: pointer;" class="fas fa fa-trash"></i>
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
			 progress: [],
			 complete: [],
			 statuses: [],

			 newTask: {
		        title: "",
		      },
		      errors: []

		}
	},

	mounted() {
		// this.getTasks();
		this.toDoTaskList();
		this.progressTaskList();
		this.completeTaskList();
	  },

	methods: {
		getTasks(){
			axios.get('/api/tasks')
				.then((res) => {
					this.statuses = res.data.data;
					// console.log(res);
				})
		},
		toDoTaskList(){
			axios.get('/api/to-do-tasks')
				.then((res) => {
					this.tasks = res.data.data;
					// console.log(this.tasks);
				})
		},
		progressTaskList(){
			axios.get('/api/in-progress-tasks')
				.then((res) => {
					this.progress = res.data.data;
					// console.log(this.progress);
				})
		},
		completeTaskList(){
			axios.get('/api/complete-tasks')
				.then((res) => {
					this.complete = res.data.data;
					// console.log(this.complete);
				})
		},

		moveTasktoProgress(id){
			axios.put(`/api/task-move/to/progress/${id}`)
				.then((res) => {
					// console.log(res.data);
					this.toDoTaskList();
					this.progressTaskList();
				})
		},
		moveTasktoDone(id){
			axios.put(`/api/task-move/to/done/${id}`)
				.then((res) => {
					// console.log(res.data);
					this.progressTaskList();
					this.completeTaskList();
					
				})
		},
		deleteTask(id){
			axios.delete(`/api/task-delete/${id}`)
				.then((res) => {
					// console.log(res.data);
					this.completeTaskList();
					
				})
		},

		addTask() {
	      axios
	        .post("/api/tasks", this.newTask)
	        .then((res) => {
	          // console.log(res);
	          this.newTask.title = '';
	          this.toDoTaskList();
	        })
	        .catch((error) => {
	          // console.log(error)
	          this.errors = error.response.data.errors;
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

	.text-red{
		color: red;
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
	  background-color: #fec6d1;
	}

	#inprogress {
	  background-color: #fec6d1;
	}

	#done {
	  background-color: #fec6d1;
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