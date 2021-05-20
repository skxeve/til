from collections import namedtuple

Task = namedtuple('Task', ['summary', 'owner', 'done', 'id'])
Task.__new__.__defaults__ = (None, None, False, None)

def test_asdict():
    # _asdict should return a dictionary.
    t_task = Task('do something', 'okken', True, 21)
    t_dict = t_task._asdict()
    expected = {
        'summary': 'do something',
        'owner': 'okken',
        'done': True,
        'id': 21,
    }
    assert t_dict == expected

