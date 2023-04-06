<?php

namespace Ushahidi\Modules\V5\Policies;

use Ushahidi\Core\Tool\Acl;
use Ushahidi\Authzn\GenericUser as User;
use Ushahidi\Modules\V5\Models\Category;
use Ushahidi\Core\Tool\Authorizer\TagAuthorizer;

class CategoryPolicy
{
    protected $authorizer;

    public function __construct(Acl $acl, TagAuthorizer $authorizer)
    {
        $this->authorizer = $authorizer;
        $this->authorizer->setAcl($acl);
    }

    public function view(User $user, Category $category)
    {
        return $this->authorizer->setUser($user)->isAllowed($category, 'search');
    }

    public function create(User $user)
    {
        return $this->authorizer->setUser($user)->isAllowed(new Category, 'create');
    }

    public function show(User $user, Category $category)
    {
        return $this->authorizer->setUser($user)->isAllowed($category, 'read');
    }

    public function delete(User $user, Category $category)
    {
        return $this->authorizer->setUser($user)->isAllowed($category, 'delete');
    }

    public function update(User $user, Category $category)
    {
        return $this->authorizer->setUser($user)->isAllowed($category, 'update');
    }
}