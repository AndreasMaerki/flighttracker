<?php
include_once 'view/View.php';


class ContactView extends View {

	public function display() {// implementation of abstract view method
		echo "<h2>Contact</h2>";
		if (!empty($this -> vars['notification'])) {//vars is a array defined in the abstract view class.if vars['key'] is empty, then true!
			echo "<p>{$this->vars['notification']}</p>";
			//return the content of vars['notification']
		}
		// the html below builds the form. the vars['key'] fills in previously stored values in the text-areas when not empty.
		// if the form was returned because of false or incomplete content, the array contains infos the user typed in before pushing the send-button
		echo <<<FORM
        <form id="contactform" action="{$this->vars['contactUri']}" method="post" name="contactform">
            <label for="contactform-subject" class="required">subject</label>
            <input type="text" id="contactform-subject" name="subject" required autocomplete="off" list="subjects" {$this->vars['validatedSubject']}>
            <datalist id="subjects">
                <option value="Question">
                <option value="Sugestion">
                <option value="Error on Site">
                <option value="General">
            </datalist>

            <label for="contactform-message" class="required">Message</label>
            <textarea id="contactform-message" name="message" rows="8" cols="50" required {$this->vars['messageClasses']}>{$this->vars['message']}</textarea>

            <label for="contactform-lastname">last name</label>
            <input type="text" id="contactform-lastname" name="lastname" {$this->vars['validatedlastName']}>

            <label for="contactform-first_name">first name</label>
            <input type="text" id="contactform-first_name" name="first_name" {$this->vars['validatedFirstName']}>

            <label for="contactform-phone">Phone</label>
            <input type="tel" id="contactform-phone" name="phone" {$this->vars['validatedPhone']}>

            <label for="contactform-email" class="required">email</label>
            <input type="email" id="contactform-email" name="email" required {$this->vars['validatedEmail']}>

            <input type="text" id="contactform-name" name="name">
            <input type="hidden" name="contact" value="1">
            <input type="submit" name="contactform_submit" value="Submit">
        </form>
FORM;
	}

}