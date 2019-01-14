<div class="close">X</div>
<div class="card card-body">
    <h3>Creat a new interview</h3>
    <form action="<?php the_permalink(); ?>" id="interviewForm" name="interviewForm" method="post">
        <div>
            <label for="typeInterview">Select type of interview</label>
            <select name="typeInterview" id="typeInterview">
                <option value="screening">Screening</option>
                <option value="phoneinterview">Phone Interview</option>
                <option value="officeinterview">In-Office Interview</option>
                <option value="test">Test</option>
                <option value="makeoffer">Make An Offer</option>
            </select>
        </div>
        <div>
            <label for="interviewrs">Interviewers:</label>
            <input type="text" name="interviewrs" />
        </div>
        <div class="interviewrsduration">
            <label for="Duration">Duration:</label>
            <select name="Duration" id="duration">
                <option value="30m">30 minutes</option>
                <option value="1hour">1 hour</option>
                <option value="2hours">2 hours</option>
                <option value="3hours">3 hours</option>
                <option value="4hours">4 hours</option>
            </select>
        </div>
        <div class="interviewrstime">
            <label for="Interviewtime">Interview Time :</label>
            <input type="text" id="Interviewtime" name="Interviewtime">
        </div>
        <div>
            <label for="InterviewDate">Interview Date :</label>
            <input type="text" id="datepicker" name="InterviewDate">
        </div>
        <div>
            <label for="interviewDetails">Interview Details (e.g vanue, phone etc)</label>
            <textarea name="interviewDetails" id="interviewDetails" cols="30" rows="5"></textarea>
        </div>
        <button type="submit">Save</button>
        <input type="hidden" name="submitted" id="submitted" value="true" />
    </form>
</div>