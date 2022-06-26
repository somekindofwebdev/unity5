export default {
    props: {
        contact: Object
    },
  template: `
    <div class="contact">
        <h3> {{ contact.last_name }}, {{ contact.first_name + " " + contact.middle_name }} </h3>
        <p> {{ contact.address || "No address recorded" }} {{ contact.postcode || "No postcode recorded" }} </p>
        <button @click="contact.active = !contact.active">{{ contact.active == 1 ? "Disable contact" : "Enable contact" }}</button>
    </div>
  `
}