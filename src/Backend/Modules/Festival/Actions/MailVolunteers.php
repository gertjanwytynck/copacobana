<?php

namespace Backend\Modules\Festival\Actions;

use Common\Uri as CommonUri;


use Backend\Core\Engine\Base\ActionIndex;
use Backend\Core\Engine\Language;
use Backend\Core\Engine\Model as FrontendModel;
use Backend\Modules\Festival\Engine\Model as BackendFestivalModel;
/**
 * This is the add-action, it will display a form to add a new artist.
 *
 * @author Gertjan Wytynck <gertjan.wytynck@gmail.com>
 */
class MailVolunteers extends ActionIndex
{
    /**
     * Execute the action.
     */
    public function execute()
    {
        parent::execute();

        $this->getData();
        $this->sendMail();
        $this->parse();
        $this->display();

    }

    /**
     * Get the data
     */
    private function getData() {
        // get the entity manager
        $em = FrontendModel::get('doctrine.orm.entity_manager');

        // get volunteers
        $this->volunteers = $em->getRepository(BackendFestivalModel::ARTIST_ENTITY_CLASS)
            ->getAllVolunteers($em);

        // get module settings
        $this->settings = $this->get('fork.settings')->getForModule($this->URL->getModule());
    }

    /**
     * Send email
     */
    private function sendMail() {
        // send mail
        $failedRecipients = array();
        $successRecipients = array();

        //  BACKEND_MODULES_PATH . '/Festival/Layout/Files/belangrijke_informatie.docx', BACKEND_MODULES_PATH . '/Festival/Layout/Files/rampenplan.docx', BACKEND_MODULES_PATH . '/Festival/Layout/Files/reglement.docx'
        foreach ($this->volunteers as $key=>$volunteer) {
            try {
                $message = \Common\Mailer\Message::newInstance("Jouw shift op Copacobana Festival")
                    ->parseHtml(
                        FRONTEND_PATH . '/Themes/Copacobana/Modules/FormBuilder/Layout/Mails/Volunteer.tpl',
                        array(
                            'shift' => $volunteer["shifts_summary"],
                            'name' => $volunteer["name"],
                        ),
                        true
                    )
                    ->setTo($volunteer["email"])
                    // ->setTo('gertjan.wytynck@gmail.com')
                    ->setFrom(array("vrijwilliger@copacobana.be" => "Jochen"))
                    ->addAttachments(array(BACKEND_MODULES_PATH . '/Festival/Layout/Files/copacobana_plein.jpeg',  BACKEND_MODULES_PATH . '/Festival/Layout/Files/infofiche.docx',))
                ;

                $message->setReplyTo(array('vrijwilliger@copacobana.be' => 'Jochen'));
                $result = $this->get('mailer')->send($message, $failedRecipients);
                if ($result === 1) {
                    array_push($successRecipients,$volunteer["email"]);
                    $em = FrontendModel::get('doctrine.orm.entity_manager');
                    $update = $em->getRepository(BackendFestivalModel::ARTIST_ENTITY_CLASS)
                    ->updateVolunteer($em, $volunteer["id"]);
                }
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }


        echo '<pre>';
        print_r($successRecipients);
        echo '</pre>';

        echo '---------';

        echo '<pre>';
        print_r($failedRecipients);
        echo '</pre>';
    }


    /**
     * Parse the form
     */
    protected function parse()
    {
        parent::parse();
    }
}
