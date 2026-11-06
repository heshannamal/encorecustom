<?php

namespace domain\Services\EmailTemplateService;

use App\Models\EmailTemplate;
use App\Models\EmailTemplateUser;

class EmailTemplateService
{
    protected $email_template;
    protected $email_template_user;

    public function __construct()
    {
        $this->email_template = new EmailTemplate();
        $this->email_template_user = new EmailTemplateUser();
    }

    public function getAllTemplates()
    {
        return $this->email_template->all();
    }

    public function getTemplateById($id)
    {
        return $this->email_template->find($id);
    }

    public function getTemplateUsers($id)
    {
        return $this->email_template_user->where('template_id', $id)->get();
    }

    public function storeEmailTemplate($data)
    {
        return $this->email_template->create($data);
    }

    public function updateEmailTemplate($data, $id)
    {
        $template = $this->getTemplateById($id);
        if ($template) {
            $template->update($data);
        }
        return $template;
    }

    public function destroyEmailTemplate($id)
    {
        $template = $this->getTemplateById($id);
        if ($template) {
            $template->delete();
            return true;
        }
        return false;
    }

    public function updateTemplateUsers($id, array $toUserIds, array $ccUserIds, array $bccUserIds)
    {
        $this->email_template_user->where('template_id', $id)->delete();

        foreach ($toUserIds as $userId) {
            $this->email_template_user->create([
                'template_id' => $id,
                'type' => 0,
                'user_id' => $userId,
            ]);
        }

        foreach ($ccUserIds as $userId) {
            $this->email_template_user->create([
                'template_id' => $id,
                'type' => 1,
                'user_id' => $userId,
            ]);
        }

        foreach ($bccUserIds as $userId) {
            $this->email_template_user->create([
                'template_id' => $id,
                'type' => 2,
                'user_id' => $userId,
            ]);
        }

        return true;
    }
}
