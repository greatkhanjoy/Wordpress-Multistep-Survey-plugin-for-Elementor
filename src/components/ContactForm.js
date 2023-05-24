import React from "react";

const ContactForm = ({ data, onChange }) => {
  return (
    <div className="flex flex-col gap-3 p-4">
      <div className="flex flex-col sm:flex-row gap-4 items-center justify-items-center">
        <input
          type="text"
          name="first_name"
          placeholder="First Name"
          value={data.first_name}
          onChange={onChange}
          className="w-full p-3"
          required
        />
        <select
          className="w-full h-[50px] px-2"
          name="country"
          onChange={onChange}
        >
          <option>Select your country</option>
          <option selected={data.country === "india"} value="india">
            India
          </option>
          <option selected={data.country === "usa"} value="usa">
            USA
          </option>
          <option selected={data.country === "uk"} value="uk">
            UK
          </option>
        </select>
      </div>
      <div className="flex flex-col sm:flex-row justify-center gap-4 items-center">
        <input
          type="text"
          name="last_name"
          placeholder="Last Name"
          value={data.last_name}
          onChange={onChange}
          className="w-full p-3"
        />
        <input
          type="number"
          name="increment"
          value={data.increment}
          onChange={onChange}
          placeholder="0"
          className="w-full p-3"
        />
      </div>
      <div className="flex w-full flex-col sm:flex-row justify-center gap-4 items-center">
        <div className="w-full sm:w-1/2">
          <input
            type="email"
            name="email"
            value={data.email}
            onChange={onChange}
            placeholder="Your Email"
            className="w-full p-3"
            required
          />
        </div>
        <div className="w-full sm:w-1/2 flex flex-col sm:flex-row gap-4">
          <input
            type="number"
            name="age"
            placeholder="Age"
            value={data.age}
            onChange={onChange}
            className="p-3 w-full sm:w-1/3"
          />
          <div className="flex gap-4">
            <label className="flex gap-2 items-center">
              <input
                type="radio"
                name="gender"
                value="male"
                checked={data.gender === "male"}
                onChange={onChange}
              />
              <span>Male</span>
            </label>
            <label className="flex gap-2 items-center">
              <input
                type="radio"
                name="gender"
                value="female"
                checked={data.gender === "female"}
                onChange={onChange}
              />
              <span>Female</span>
            </label>
          </div>
        </div>
      </div>
    </div>
  );
};

export default ContactForm;
