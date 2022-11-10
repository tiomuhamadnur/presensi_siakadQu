<?php

namespace ShiftOneLabs\LaravelCascadeDeletes\Tests;

use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Database\Eloquent\Relations\Relation;
use ShiftOneLabs\LaravelCascadeDeletes\Tests\Models\User;
use ShiftOneLabs\LaravelCascadeDeletes\Tests\Models\SoftUser;
use ShiftOneLabs\LaravelCascadeDeletes\Tests\FeatureDetection;

class TraitTest extends TestCase
{
    public function testCanGetCascadeDeletesProperty()
    {
        $user = new User();

        $this->assertNotEmpty($user->getCascadeDeletes());
    }

    public function testCanSetCascadeDeletesProperty()
    {
        $user = new User();
        $newDeletes = ['new', 'deletes'];

        $user->setCascadeDeletes($newDeletes);

        $this->assertEquals($newDeletes, $user->getCascadeDeletes());
    }

    public function testGetRelationNamesReturnsArrayFromArray()
    {
        $user = new User();

        $names = $this->callRestrictedMethod($user, 'getCascadeDeletesRelationNames');

        $this->assertInternalType('array', $names);
    }

    public function testGetRelationNamesReturnsPopulatedArrayFromArray()
    {
        $user = new User();

        $names = $this->callRestrictedMethod($user, 'getCascadeDeletesRelationNames');

        $this->assertNotEmpty($names);
    }

    public function testGetRelationNamesReturnsArrayFromString()
    {
        $user = new User();
        $user->setCascadeDeletes('string_value');

        $names = $this->callRestrictedMethod($user, 'getCascadeDeletesRelationNames');

        $this->assertInternalType('array', $names);
    }

    public function testGetRelationNamesReturnsPopulatedArrayFromString()
    {
        $user = new User();
        $user->setCascadeDeletes('string_value');

        $names = $this->callRestrictedMethod($user, 'getCascadeDeletesRelationNames');

        $this->assertNotEmpty($names);
    }

    public function testGetRelationNamesReturnsArrayFromNonEmptyValue()
    {
        $user = new User();
        $user->setCascadeDeletes(1234);

        $names = $this->callRestrictedMethod($user, 'getCascadeDeletesRelationNames');

        $this->assertInternalType('array', $names);
    }

    public function testGetRelationNamesReturnsPopulatedArrayFromNonEmptyValue()
    {
        $user = new User();
        $user->setCascadeDeletes(1234);

        $names = $this->callRestrictedMethod($user, 'getCascadeDeletesRelationNames');

        $this->assertNotEmpty($names);
    }

    public function testGetRelationNamesReturnsArrayFromEmptyValue()
    {
        $user = new User();
        $user->setCascadeDeletes(null);

        $names = $this->callRestrictedMethod($user, 'getCascadeDeletesRelationNames');

        $this->assertInternalType('array', $names);
    }

    public function testGetRelationNamesReturnsEmptyArrayFromEmptyValue()
    {
        $user = new User();
        $user->setCascadeDeletes(null);

        $names = $this->callRestrictedMethod($user, 'getCascadeDeletesRelationNames');

        $this->assertEmpty($names);
    }

    public function testGetRelationsReturnsRelationObjectsForValidNames()
    {
        $user = new User();
        $user->setCascadeDeletes(['friends', 'posts', 'photos']);
        $expected = [
            'friends' => $user->friends(),
            'posts' => $user->posts(),
            'photos' => $user->photos(),
        ];

        $relations = $this->callRestrictedMethod($user, 'getCascadeDeletesRelations');

        $this->assertEquals($expected, $relations);
    }

    public function testGetRelationsReturnsNullForInvalidNames()
    {
        $user = new User();
        $user->setCascadeDeletes(['friends', 'asdf', 1234]);
        $expected = [
            'friends' => $user->friends(),
            'asdf' => null,
            1234 => null,
        ];

        $relations = $this->callRestrictedMethod($user, 'getCascadeDeletesRelations');

        $this->assertEquals($expected, $relations);
    }

    public function testGetRelationsExcludesEmptyNames()
    {
        $user = new User();
        $user->setCascadeDeletes(['friends', '', 0, null, 'posts']);
        $expected = [
            'friends' => $user->friends(),
            'posts' => $user->posts(),
        ];

        $relations = $this->callRestrictedMethod($user, 'getCascadeDeletesRelations');

        $this->assertEquals($expected, $relations);
    }

    public function testGetInvalidRelationsReturnsInvalidNames()
    {
        $user = new User();
        $user->setCascadeDeletes(['friends', 'asdf', 1234]);
        $expected = ['asdf', 1234];

        $names = $this->callRestrictedMethod($user, 'getInvalidCascadeDeletesRelations');

        $this->assertEquals($expected, $names);
    }

    public function testGetInvalidRelationsExcludesEmptyNames()
    {
        $user = new User();
        $user->setCascadeDeletes(['asdf', '', 0, null, 1234]);
        $expected = ['asdf', 1234];

        $names = $this->callRestrictedMethod($user, 'getInvalidCascadeDeletesRelations');

        $this->assertEquals($expected, $names);
    }

    public function testIsForceDeletingReturnsTrueWhenForceDeleting()
    {
        $user = new SoftUser();

        if (FeatureDetection::softDeleteAsProperty()) {
            $this->setRestrictedValue($user, 'softDelete', false);
        } else {
            $this->setRestrictedValue($user, 'forceDeleting', true);
        }

        $this->assertTrue($user->isCascadeDeletesForceDeleting());
    }

    public function testIsForceDeletingReturnsFalseWhenNotForceDeleting()
    {
        $user = new SoftUser();

        $this->assertFalse($user->isCascadeDeletesForceDeleting());
    }

    public function testGetCascadeDeletesRelationQueryReturnsRelation()
    {
        $user = new User();

        $query = $user->getCascadeDeletesRelationQuery($user->getCascadeDeletesRelationNames()[0]);

        $this->assertInstanceOf(Relation::class, $query);
    }

    public function testCascadeDeletesRelationQueryExcludesTrashedWhenNotForceDeleting()
    {
        $user = new SoftUser();

        $query = $user->getCascadeDeletesRelationQuery($user->getCascadeDeletesRelationNames()[0])->getQuery();

        if (FeatureDetection::handlesRemovedScopes()) {
            $this->assertNotContains(SoftDeletingScope::class, $query->removedScopes());
        } else {
            $hasConstraint = false;

            foreach ((array) $query->getQuery()->wheres as $key => $where) {
                if ($where['type'] == 'Null' && $where['column'] == $user->getQualifiedDeletedAtColumn()) {
                    $hasConstraint = true;
                    break;
                }
            }

            $this->assertTrue($hasConstraint);
        }
    }

    public function testCascadeDeletesRelationQueryIncludesTrashedWhenForceDeleting()
    {
        $user = new SoftUser();

        if (FeatureDetection::softDeleteAsProperty()) {
            $this->setRestrictedValue($user, 'softDelete', false);
        } else {
            $this->setRestrictedValue($user, 'forceDeleting', true);
        }

        $query = $user->getCascadeDeletesRelationQuery($user->getCascadeDeletesRelationNames()[0])->getQuery();

        if (FeatureDetection::handlesRemovedScopes()) {
            $this->assertContains(SoftDeletingScope::class, $query->removedScopes());
        } else {
            $hasConstraint = false;

            foreach ((array) $query->getQuery()->wheres as $key => $where) {
                if ($where['type'] == 'Null' && $where['column'] == $user->getQualifiedDeletedAtColumn()) {
                    $hasConstraint = true;
                    break;
                }
            }

            $this->assertFalse($hasConstraint);
        }
    }
}
