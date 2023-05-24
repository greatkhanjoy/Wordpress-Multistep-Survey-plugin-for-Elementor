<?php

function generateSurveyHTML($settings)
{
?>
    <div class="greatkhanjoy-survey-elementor greatkhanjoy-survey-use w-full">
        <div class="w-full bg-gray-300 mx-auto">
            <div class="bg-gray-200 mx-auto p-5 w-full">
                <h2 class="text-center text-xl leading-normal font-medium">
                    <?php echo $settings['title'] ?>
                </h2>

                <div class="w-full bg-white rounded-full dark:bg-gray-700">
                    <div class="bg-blue-600 text-xs font-medium text-blue-100 text-center p-0.5 leading-none rounded-full flex justify-center" style="width: 45%">
                        45%
                    </div>
                </div>
            </div>
            <div class="survey_body py-4">
                <div class="flex flex-col gap-3 p-4">
                    <div class="flex flex-col sm:flex-row gap-4 items-center justify-items-center">
                        <input type="text" name="first_name" placeholder="First Name" value="" class="w-full p-3" required />
                        <select class="w-full h-[50px] px-2" name="country">
                            <option>Select your country</option>
                            <option value="india">
                                India
                            </option>
                            <option value="usa">
                                USA
                            </option>
                            <option value="uk">
                                UK
                            </option>
                        </select>
                    </div>
                    <div class="flex flex-col sm:flex-row justify-center gap-4 items-center">
                        <input type="text" name="last_name" placeholder="Last Name" class="w-full p-3" />
                        <input type="number" name="increment" placeholder="0" class="w-full p-3" />
                    </div>
                    <div class="flex flex-col sm:flex-row justify-center gap-4 items-center w-full">
                        <div class="w-full sm:w-1/2">
                            <input type="email" name="email" placeholder="Your Email" class="w-full p-3" />
                        </div>
                        <div class="w-full sm:w-1/2 flex flex-col sm:flex-row gap-4">
                            <input type="number" name="age" placeholder="Age" class="p-3 w-full sm:w-1/3" />
                            <div class="flex gap-4">
                                <label class="flex gap-2 items-center">
                                    <input type="radio" name="gender" value="male" />
                                    <span>Male</span>
                                </label>
                                <label class="flex gap-2 items-center">
                                    <input type="radio" name="gender" value="female" />
                                    <span>Female</span>
                                </label>
                            </div>

                        </div>
                    </div>
                </div>
                <?php foreach ($settings['question_list'] as $index => $item) : ?>
                    <div class="flex flex-col gap-3 p-4">
                        <h3 class="text-xl leading-normal font-semibold"><?php echo $item['question']; ?></h3>
                        <div class="flex flex-col gap-4">
                            <?php foreach ($item['options'] as $option) : ?>
                                <?php if ($item['question_type'] === 'checkbox') { ?>
                                    <label class="flex gap-2 items-center">
                                        <input type="checkbox" required />
                                        <span><?php echo $option['option'] ?></span>
                                    </label>
                                <?php } else { ?>
                                    <label class="flex gap-2 items-center">
                                        <input type="radio" required />
                                        <span><?php echo $option['option'] ?></span>
                                    </label>
                                <?php } ?>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endforeach; ?>

            </div>
            <div class="survey_footer flex justify-center gap-2 p-5 bg-gray-200">
                <button type="button" class="bg-gray-300 px-6 py-2">
                    BACKWARD
                </button>
                <button type="submit" class="bg-black text-white px-6 py-2">
                    FORWARD
                </button>
            </div>
        </div>
        <pre style="display:none;"><?php echo wp_json_encode($settings) ?></pre>
    </div>
<?php
}
