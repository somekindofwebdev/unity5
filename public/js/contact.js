export default {
    props: {
        first_name: String,
        middle_name: String,
        last_name: String,
        date_of_birth: String,
        address: String,
        postcode: String,
        telephone_number: String,
        email: String
    },
  template: `
    <div class="contact">
        <h3> {{ last_name }}, {{ first_name + " " + middle_name }} </h3>
        <p> {{ address || "No address recorded" }} {{ postcode || "No postcode recorded" }} </p>
    </div>
  `
}