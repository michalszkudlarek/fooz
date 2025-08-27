<?php
/**
 * Header with accordion block template.
 *
 * @param array $block The block settings and attributes.
 * @param string $content The block inner HTML (empty).
 * @param bool $is_preview True during AJAX preview.
 * @param (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'header-accordion-' . $block['id'];
if (!empty($block['anchor'])) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = '';
if (!empty($block['className'])) {
    $className .= $block['className'];
}
if (!empty($block['align'])) {
    $className .= ' align' . $block['align'];
}

$faq_group = get_field('faq_group');

if (!empty(array_filter($faq_group))) { ?>
    <section class="wp-block-recruitment-task-faq-accordion <?php if (!empty($className)) {
        echo $className;
    } ?>"
         id="<?php if (!empty($id)) {
             echo $id;
         } ?>"
    >
        <?php
        $faq_header = $faq_group['faq_header'];
        if ($faq_header) { ?>
            <h2 class="faq-accordion-title">
                <?php echo $faq_header; ?>
            </h2><?php
        }

        $faq_repeater = $faq_group['faq_repeater'];
        if ($faq_repeater) { ?>
            <div class="faq-accordion-items"> <?php
                foreach ($faq_repeater as $element) { ?>
                    <div class="wp-block-recruitment-task-faq-item"><?php
                        if (isset($element['faq_question'])) { ?>
                            <h3 class="faq-question">
                                <div class="faq-question-text-wrapper">
                                    <div class="faq-question-text">
                                        <?php echo $element['faq_question']; ?>
                                    </div>
                                    <div class="faq-question-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                             stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                             stroke-linejoin="round">
                                            <path d="m6 9 6 6 6-6"/>
                                        </svg>
                                    </div>
                                </div>
                            </h3><?php
                        }
                        if (isset($element['faq_answer'])) { ?>
                            <div class="faq-answer">
                                <p><?php echo $element['faq_answer']; ?></p>
                            </div><?php
                        } ?>
                    </div><?php
                } ?>
            </div> <?php
        } ?>
    </section><?php
}
