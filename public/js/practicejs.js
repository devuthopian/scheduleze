/*var app = new Vue({
	el: '#root',
	data: {
		newName: '',
		names: [],
		title: 'This is the title for vuejs practical verification',
		callname: 'color-red',
		isLoading: false,

		tasks: [
			{description: 'Go to Temple', completed: false},
			{description: 'Need Rest', completed: false},
			{description: 'Task medicine', completed: true},
			{description: 'The Dose was too high, I can\'t able to bear it', completed: true}
		]
	},

	methods: {
		addName() {
			this.names.push(this.newName);

			this.newName = '';
		},

		toggleClass() {
			this.isLoading = true;
		}
	},

	computed: {
		rmessage() {
			return this.title.split('').reverse().join('');
		},
		incompletedtasks() {
			return this.tasks.filter(task  => ! task.completed);
		}
	}
});*/

/*Vue.component('task-list', {
	template: `
	<div>
		<task v-for="task in tasks">{{ task.task }}</task>
	</div>
	`,

	data() {
		return {
			tasks: [
				{ task: 'Waiting', completed: false },
				{ task: 'for', completed: false },
				{ task: 'Shri', completed: true },
				{ task: 'Hari', completed: true }
			]
		};
	}
});

Vue.component('task', {
	template: '<li><slot></slot></li>'
});*/

Vue.component('tabs', {
	template: `
		<div>
			<div class="tabs">
				<ul>
					<li v-for="tab in tabs" :class="{ 'is-active': tab.isActive }">
						<a href="#" @click="selectTab(tab)">{{ tab.name }}</a>
					</li>
				</ul>
			</div>

			<div class="tabs-details">
				<slot></slot>
			</div>
		</div>
	`,

	data() {
		return { tabs: [] };
	},

	created() {
		this.tabs = this.$children;
	},

	methods: {
		selectTab(selectedTab) {
			this.tabs.forEach(tab => {
				tab.isActive = (tab.name == selectedTab.name);
			});
		}
	}
});

Vue.component('tab', {
	template: `<div v-show="isActive"><slot></slot></div>`,
	props: {
		name: { required: true },
		selected: { default: false }
	},
	data() {
		return {
			isActive: false
		};
	},
	mounted() {
		this.isActive = this.selected;
	}
});

Vue.component('message', {
	props: ['title', 'body'],

	data() {
		return{
			isVisible: true
		};
	},
	template: `<article class="message" v-show="isVisible">
				<div class="message-header">
					<p>{{ title }}</p>
					<button class="delete" aria-label="delete" @click="isVisible = false"></button>
				</div>
				<div class="message-body">
					{{ body }}
				</div>
			</article>`
});

Vue.component('modal', {
	props: ['para'],
	template: `<div class="modal is-active">
				<div class="modal-background"></div>
					<div class="modal-content">
						<p><slot></slot></p>
					</div>
				<button class="modal-close is-large" aria-label="close" @click="$emit('close')"></button>
			</div>`
});

new Vue({
	el: '#root',
	data: {
		showModal: false
	}
});