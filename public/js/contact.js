export default {
    props: {
        contact: Object
    },
  template: `
    <div class="contact">
        <h3> {{ contact.last_name }}, {{ contact.first_name + " " + contact.middle_name }} </h3>
        <p> {{ contact.address || "No address recorded" }} {{ contact.postcode || "No postcode recorded" }} </p>
        <label>Active:</label>
        <input type="checkbox" v-model="contact.active" />
    </div>
  `
}