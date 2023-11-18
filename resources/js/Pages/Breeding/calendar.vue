<template>
    <div>
      <h2>{{ currentMonth.format("MMMM YYYY") }}</h2>
      <table>
        <thead>
          <tr>
            <th v-for="day in daysOfWeek" :key="day">{{ day }}</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="week in calendar" :key="week">
            <td v-for="day in week" :key="day.date">
              <div :class="{ 'breeding-date': hasBreedingEvents(day.date) }">
                {{ day.date.date() }}
                <ul v-if="day.events.length">
                  <li v-for="event in day.events" :key="event.id">{{ event.name }}</li>
                </ul>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </template>

  <script setup>
  import { defineProps, ref, onMounted } from 'vue';
  import moment from 'moment';

  const props = defineProps(['breedingEvents', 'selectedDate']);

  const currentMonth = moment();
  const daysOfWeek = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
  const calendar = ref([]);

  const generateCalendar = async () => {
    const startOfMonth = currentMonth.clone().startOf("month").startOf("week");
    const endOfMonth = currentMonth.clone().endOf("month").endOf("week");

    let currentDate = startOfMonth.clone();
    let newCalendar = [];

    while (currentDate.isBefore(endOfMonth)) {
      let week = [];
      for (let i = 0; i < 7; i++) {
        const events = getEventsForDate(currentDate.clone());
        week.push({
          date: currentDate.clone(),
          events,
        });
        currentDate.add(1, "day");
      }
      newCalendar.push(week);
    }

    calendar.value = newCalendar;
  };

  const getEventsForDate = (date) => {
    // Filter breeding events for the current date
    return (
      props.breedingEvents.filter((event) =>
        moment(event.date).isSame(date, 'day')
      ) || []
    );
  };

  const hasBreedingEvents = (date) => {
    return getEventsForDate(date).length > 0;
  };

  onMounted(() => {
    generateCalendar();
  });
  </script>

  <style scoped>
  table {
    width: 100%;
    border-collapse: collapse;
  }
  th, td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: center;
  }

  .breeding-date {
    background-color: lightblue;  /* Adjust the styling as needed */
  }

  ul {
    list-style: none;
    padding: 0;
    margin: 0;
  }
  </style>
