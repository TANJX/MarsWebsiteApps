<template>
  <div>
    <div class="main">
      <div class="title">
        <div class="container">
          <h1>Events</h1>
          <p>Mars' life</p>
        </div>
      </div>

      <div class="main container">
        <div class="selection-checkboxes clearfix">
          <div class="left">
            <div v-for="(filter, index) in filter_1" :key="index">
              <input
                class="styled-checkbox" :id="'type-' + index" type="checkbox"
                v-model="checked_filter_1" v-bind:value="index"
              >
              <label :for="'type-' + index">{{filter}}</label>
            </div>
          </div>
          <div class="right">
            <div v-for="(filter, index) in filter_2" :key="index">
              <input
                class="styled-checkbox" :id="'type2-' + index" type="checkbox"
                v-model="checked_filter_2" v-bind:value="index"
              >
              <label :for="'type2-' + index">{{filter}}</label>
            </div>
          </div>
          <div class="right"></div>
        </div>
        <div class="new-event" v-show="logged_in">
          <i class="material-icons"
             @click="modal_on = true"
          >add_circle_outline</i>
        </div>
        <EventCard
          v-for="(event, index) in events" :key="index" :event="event"
          v-show="event.filter_1 && event.filter_2"
        ></EventCard>
      </div>
    </div>
    <Footer></Footer>

    <div class="modal" v-show="modal_on" @click="modal_on = false">
      <div class="modal-container" @click.stop>
        <div class="modal-head">
          <h2>Add an Event</h2>
        </div>
        <div class="modal-body">
          <div class=" form-group">
            <label for="inputName" class="bmd-label-floating ">Name</label>
            <input
              id="inputName" class="form-control"
              placeholder="Type in text" type="text" required
              v-model="new_event.name"
            />
          </div>
          <div class="form-group">
            <label for="inputDate" class="bmd-label-floating ">Date</label>
            <input
              id="inputDate" name="date" class="form-control " required
              type="date"
              v-model="new_event.date"
            />
          </div>
          <div class="form-group">
            <label for="inputType" class="bmd-label-floating ">Type</label>
            <select
              id="inputType" name="type" class="custom-select mb-2 mr-sm-2 mb-sm-0"
              v-model="new_event.type"
            >
              <option selected value="default">Choose...</option>
              <option value="school">School</option>
              <option value="life">Life</option>
              <option value="work">Work</option>
              <option value="device">Device</option>
            </select>
          </div>
          <div class="button-div">
            <button
              class="btn btn-primary btn-raised"
              :disabled="!form_valid"
              @click="addEvent"
            >Add
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import moment from 'moment';
import EventCard from '../components/EventCard.vue';
import Footer from '../components/Footer.vue';
import { checkToken, eventsGet, eventsAdd } from '../data';

export default {
  name: 'event',
  data() {
    return {
      events: [],
      filter_1: ['All', 'Life', 'School', 'Work', 'Device'],
      filter_2: ['All', 'Past', 'Future'],
      checked_filter_1: [0, 1, 2, 3, 4],
      checked_filter_2: [0, 1, 2],
      checked_filter_ignored_1: false,
      checked_filter_ignored_2: false,
      new_event: {
        name: '',
        date: '',
        type: 'default',
      },
      modal_on: false,
    };
  },
  computed: {
    logged_in() {
      return checkToken();
    },
    form_valid() {
      return this.new_event.name && this.new_event.date && this.new_event.type !== 'default';
    },
  },
  components: {
    EventCard,
    Footer,
  },
  watch: {
    checked_filter_1(new_var, old_var) {
      this.events.forEach((e) => {
        const ind = this.filter_1.findIndex(type => type.toLowerCase() === e.type);
        if (ind < 0) e.filter_1 = false;
        e.filter_1 = new_var.includes(ind);
      });

      if (this.checked_filter_ignored_1) {
        this.checked_filter_ignored_1 = false;
        return;
      }
      // All was selected
      if (old_var.includes(0)) {
        if (!new_var.includes(0)) {
          this.checked_filter_1 = [];
        } else {
          for (let i = 0; i < this.checked_filter_1.length; i++) {
            if (this.checked_filter_1[i] === 0) {
              this.checked_filter_1.splice(i, 1);
              break;
            }
          }
        }
        this.checked_filter_ignored_1 = true;
      }
      // All was not selected
      if (!old_var.includes(0)) {
        if (new_var.includes(0)) {
          this.checked_filter_1 = [...Array(this.filter_1.length).keys()];
          this.checked_filter_ignored_1 = true;
        } else if (new_var.length === this.filter_1.length - 1) {
          this.checked_filter_1.push(0);
          this.checked_filter_ignored_1 = true;
        }
      }
    },
    checked_filter_2(new_var, old_var) {
      this.events.forEach((e) => {
        if (new_var.includes(1) && moment(e.date).diff(moment(), 'days') < 0) {
          e.filter_2 = true;
        } else if (new_var.includes(2) && moment(e.date).diff(moment(), 'days') >= 0) {
          e.filter_2 = true;
        } else {
          e.filter_2 = false;
        }
      });

      if (this.checked_filter_ignored_2) {
        this.checked_filter_ignored_2 = false;
        return;
      }
      // All was selected
      if (old_var.includes(0)) {
        if (!new_var.includes(0)) {
          this.checked_filter_2 = [];
        } else {
          for (let i = 0; i < this.checked_filter_2.length; i++) {
            if (this.checked_filter_2[i] === 0) {
              this.checked_filter_2.splice(i, 1);
              break;
            }
          }
        }
        this.checked_filter_ignored_2 = true;
      }
      // All was not selected
      if (!old_var.includes(0)) {
        if (new_var.includes(0)) {
          this.checked_filter_2 = [...Array(this.filter_2.length).keys()];
          this.checked_filter_ignored_2 = true;
        } else if (new_var.length === this.filter_2.length - 1) {
          this.checked_filter_2.push(0);
          this.checked_filter_ignored_2 = true;
        }
      }
    },
    modal_on(new_var) {
      if (new_var) {
        document.body.classList.add('modal-on');
      } else {
        document.body.classList.remove('modal-on');
      }
    },
  },
  methods: {
    addEvent() {
      if (!this.form_valid) {
        return;
      }
      this.modal_on = false;
      const date = moment(this.new_event.date).format('YYYY-MM-DD');
      eventsAdd(this.new_event.name, date, this.new_event.type).then(() => {
        this.updateEvent();
        this.new_event = {
          name: '',
          date: '',
          type: 'default',
        };
      });
    },
    updateEvent() {
      eventsGet().then((data) => {
        this.events = data;
        this.events.sort((a, b) => moment(a.date).diff(moment(b.date), 'days'));
        this.events.forEach((e) => {
          const ind = this.filter_1.findIndex(type => type.toLowerCase() === e.type);
          if (ind < 0) e.filter_1 = false;
          e.filter_1 = this.checked_filter_1.includes(ind);

          if (this.checked_filter_2.includes(1) && moment(e.date).diff(moment(), 'days') < 0) {
            e.filter_2 = true;
          } else if (this.checked_filter_2.includes(2) && moment(e.date).diff(moment(), 'days') >= 0) {
            e.filter_2 = true;
          } else {
            e.filter_2 = false;
          }
        });
      });
    },
  },
  mounted() {
    this.updateEvent();
  },
};
</script>

<style lang="scss">
body.modal-on {
  overflow: hidden;
}
</style>

<style scoped lang="scss">
.main {
  font-family: "source-han-sans-japanese", "source-han-sans-simplified-c", sans-serif;
  margin-bottom: 250px;
}

.title {
  padding-top: 25px;
  padding-bottom: 1px;
  margin-bottom: 5px;
  background-color: greenyellow;
}

.material-icons {
  font-size: 48px;
  display: block;
  width: 100%;
  text-align: center;
  cursor: pointer;
  padding: 15px 0;
}

.material-icons.disabled {
  color: #b1b1b1;
  cursor: default;
}

.card {
  margin: 0 auto;
}

// checkboxes

.selection-checkboxes div div {
  display: inline;
  margin-right: 10px;
  margin-left: 10px;
}

.selection-checkboxes {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
}

.right {
  margin-left: auto;
}

.styled-checkbox {
  position: absolute;
  opacity: 0;
}

.styled-checkbox + label {
  position: relative;
  cursor: pointer;
  padding: 0;
}

.styled-checkbox + label:before {
  content: '';
  margin-right: 10px;
  display: inline-block;
  vertical-align: text-top;
  width: 20px;
  height: 20px;
  background: #ccc;
  border: 1px solid #999;
}

.styled-checkbox:hover + label:before {
  background-color: greenyellow;
}

.styled-checkbox:focus + label:before {
  box-shadow: 0 0 0 3px rgba(0, 0, 0, 0.12);
}

.styled-checkbox:checked + label:before {
  background-color: lawngreen;
  border: 0 solid #999;
}

.styled-checkbox:checked + label:after {
  content: '';
  position: absolute;
  left: 5px;
  top: 9px;
  background: white;
  width: 2px;
  height: 2px;
  box-shadow: 2px 0 0 white, 4px 0 0 white, 4px -2px 0 white, 4px -4px 0 white, 4px -6px 0 white, 4px -8px 0 white;
  transform: rotate(45deg);
}

@media (max-width: 768px) {
  .left {
    padding-bottom: 10px;
  }

  .right {
    padding-top: 10px;
    width: 100%;
    margin-left: 0;
    border-top: 1px solid #787878;
  }
}


.modal {
  position: absolute;
  top: 0;
  left: 0;
  height: 100vh;
  width: 100vw;
  background-color: rgba(0, 0, 0, 0.25);
  display: block;

  .modal-container {
    /*height: 300px;*/
    width: 400px;
    position: absolute;
    left: 50%;
    top: 50%;
    background-color: white;
    display: block;
    transform: translate(-50%, -50%);
    box-shadow: 0 3px 5px -1px rgba(0, 0, 0, .2), 0 6px 10px 0 rgba(0, 0, 0, .14), 0 1px 18px 0 rgba(0, 0, 0, .12);

  }

  .modal-head {
    height: 60px;
    background-color: greenyellow;
    padding: 17px 30px 0;

    h2 {
      font-size: 1.6rem;
    }
  }

  .modal-body {
    padding: 15px 30px 15px;

    .button-div {
      text-align: right;
    }

    select {
      margin-left: 25px;
    }
  }
}
</style>
